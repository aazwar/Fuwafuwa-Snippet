let util = {
    Uploader: {
        // section has data structure like this:
        // { 
        //    name: 'Original file name',
        //    url: 'file url',
        //    downloadkey: 'file download key',
        //    meta: 'other file information'
        // }
        deleteUrl: '',
        uploadUrl: '',
        downloadUrl: '',
        fileUpload: null,
        uploadProcess(description, callback, other) {
            if (!this.uploadUrl) {
                popupError("Uploader is not initialized");
                return;
            }
            this.fileUpload.click();
            this.fileUpload.setAttribute('data-description', description);
            this.fileUpload.setAttribute('data-callback', callback);
            if (other)
                this.fileUpload.setAttribute('data-other', other);
        },
        UploadCallback(data, section) {
            SetProperty(this, section, data);
            this.fileUpload.value = null;
        },
        DeleteFile(section) {
            if (!this.deleteUrl) {
                popupError("Uploader is not initialized");
                return;
            }
            let secVal = GetProperty(this, section);
            secVal.downloadkey && popupDialog("Delete file", `Delete file "${secVal.name}"?`, () => {
                fetchData(this.deleteUrl, { downloadkey: secVal.downloadkey });
                SetProperty(this, section, {});
            });
        },
        initUploader(xdata, uploadUrl, deleteUrl, downloadUrl, accept) {
            xdata['uploadUrl'] = uploadUrl;
            xdata['deleteUrl'] = deleteUrl;
            xdata['downloadUrl'] = downloadUrl;
            const fileUpload = document.createElement("input");
            fileUpload.setAttribute('type', 'file');
            fileUpload.setAttribute('id', 'fileUpload' + Math.floor(Math.random() * 100));
            fileUpload.setAttribute('accept', accept);
            fileUpload.setAttribute('class', 'hidden');
            fileUpload.addEventListener('change', () => {
                const selectedFile = fileUpload.files[0];
                if (selectedFile) {
                    const callback = fileUpload.getAttribute('data-callback');
                    const description = fileUpload.getAttribute('data-description');
                    const other = fileUpload.getAttribute('data-other');
                    const formData = new FormData();
                    formData.append('description', description);
                    formData.append('file', selectedFile);
                    fetchData(uploadUrl, formData, false).then(data => xdata[callback](data, other)).catch(err => popupError(err));
                }
            });
            document.body.append(fileUpload);
            xdata.fileUpload = fileUpload;
        }
    },
}
const GetProperty = (obj, target) => {
    // Split path using regular expression to support both dot and bracket notation
    const pathSegments = target.split(/[\.\[\]]+/).filter(segment => segment.length > 0);

    // Iterate through the path segments
    for (let i = 0; i < pathSegments.length; i++) {
        if (obj === null || obj === undefined) {
            return undefined; // Return undefined if a segment is not found
        }
        obj = obj?.[pathSegments[i]]; // Use optional chaining-like check
    }

    return obj;
}

const SetProperty = (obj, propPath, value) => {
    const pathSegments = propPath.split(/[\.\[\]]+/).filter(segment => segment.length > 0);
    const lastSegment = pathSegments.pop();

    for (let i = 0; i < pathSegments.length; i++) {
        const key = pathSegments[i];

        // Initialize path if it's undefined or null
        if (obj[key] === undefined || obj[key] === null) {
            // Determine whether the next path segment is a number (array index)
            obj[key] = isNaN(pathSegments[i + 1]) ? {} : [];
        }

        obj = obj[key];
    }

    // Use optional chaining to set the value
    if (obj) {
        obj[lastSegment] = value;
    }
}

const JsonAssign = (obj1, obj2, accept_property = true) => {
    // Function to safely parse JSON strings
    const tryParseJSON = (str) => {
        try {
            return JSON.parse(str);
        } catch (e) {
            return str;
        }
    };

    Object.keys(obj2).forEach(key => {
        const value = obj2[key];

        // If the value is a non-empty string and looks like JSON, try parsing it
        if (typeof value === 'string' && (value.startsWith('{') || value.startsWith('['))) {
            const parsedValue = tryParseJSON(value);

            // If the key exists in obj1 and is an object, perform a deep merge
            if (obj1[key] && typeof obj1[key] === 'object' && typeof parsedValue === 'object') {
                deepAssign(obj1[key], parsedValue);
            } else {
                // Assign the parsed value if new property is allowed or if the property already exists
                if (accept_property || obj1.hasOwnProperty(key)) {
                    obj1[key] = parsedValue;
                }
            }
        } else {
            // Otherwise, just assign the value directly
            if (accept_property || obj1.hasOwnProperty(key)) {
                obj1[key] = value;
            }
        }
    });
};

const FlattenJson = (obj) => {
    // Safely stringify JSON objects, handling cyclic references
    const safeStringify = (value) => {
        try {
            return JSON.stringify(value);
        } catch (error) {
            if (error instanceof TypeError) {
                console.error('Failed to stringify due to cyclic reference:', value);
                return JSON.stringify(makeCyclicSafe(value));
            }
            return null;
        }
    };

    // Remove cyclic references from objects
    const makeCyclicSafe = (obj, seen = new Set()) => {
        if (obj && typeof obj === 'object') {
            if (seen.has(obj)) {
                return '[Cyclic Reference]';
            }
            seen.add(obj);

            // Handle array and object differently
            if (Array.isArray(obj)) {
                return obj.map((item) => makeCyclicSafe(item, seen));
            } else {
                return Object.fromEntries(
                    Object.entries(obj).map(([key, value]) => [key, makeCyclicSafe(value, seen)])
                );
            }
        }
        return obj;
    };

    const result = { ...obj };

    Object.keys(result).forEach((key) => {
        if (result[key] && typeof result[key] === 'object') {
            // Safely stringify objects and arrays
            result[key] = safeStringify(result[key]);
        }
    });

    return result;
};

const download = (path, filename) => {
    // Create a new anchor link
    const anchor = document.createElement('a');
    anchor.href = path;
    anchor.download = filename;

    // Append the anchor to the DOM
    document.body.appendChild(anchor);

    // Trigger the `click` event to start the download
    anchor.click();

    // Remove the anchor element from the DOM
    document.body.removeChild(anchor);
};
