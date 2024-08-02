/**
 * Converts a column letter (e.g., "A", "B", "AA") to its corresponding zero-based index in a spreadsheet column.
 */
function columnLetterToIndex(column) {
    let index = 0;
    for (let i = 0; i < column.length; i++) {
        index = index * 26 + (column.charCodeAt(i) - 'A'.charCodeAt(0)) + 1;
    }
    return index - 1; // Subtract 1 to convert to zero-based index
}

/**
 * Converts a numerical index to a corresponding column letter in Excel format.
 */
function indexToColumnLetter(index) {
    const chars = [];
    while (index >= 0) {
        chars.push(String.fromCharCode((index % 26) + 65));
        index = Math.floor(index / 26) - 1;
    }
    return chars.reverse().join('');
}

/**
 * Decodes a cell address into its corresponding column index and row number.
 */
function decodeCell(address) {
    const match = address.match(/^([A-Z]+)(\d+)$/);
    if (!match) throw new Error(`Invalid cell address: ${address}`);

    const [, column, row] = match;
    const colIndex = columnLetterToIndex(column);

    return { col: colIndex, row: parseInt(row, 10) };
}

/**
 * Compares the header of a worksheet in a workbook with a given header array 
 * to determine if they match.
 */
const checkHeader = (worksheet, header, startHeaderCell = "A1") => {
    let [_, startCol, startRow] = startHeaderCell.match(/([a-zA-Z]+)(\d+)/);
    startCol = columnLetterToIndex(startCol);
    for (let i = 0; i < header.length; i++) {
        const cellValue = worksheet.getCell(`${indexToColumnLetter(startCol + i)}${startRow}`).value;
        if (cellValue?.toString().toLowerCase() !== header[i].toLowerCase()) {
            return false; // Mismatch found, return false
        }
    }
    return true;
};


/**
 * Extracts data from a specified range in a workbook sheet.
 */
const getSheetValues = (worksheet, startCell, endCell) => {
    const startCellAddress = worksheet.getCell(startCell);
    const endCellAddress = worksheet.getCell(endCell);
    const startRow = startCellAddress.row;
    const endRow = endCellAddress.row;
    const startCol = startCellAddress.col;
    const endCol = endCellAddress.col;

    // Read the values from the range and store them in a matrix
    const matrix = [];
    for (let row = startRow; row <= endRow; row++) {
        const rowValues = [];
        for (let col = startCol; col <= endCol; col++) {
            const cellValue = worksheet.getRow(row).getCell(col).value;
            rowValues.push(cellValue);
        }
        matrix.push(rowValues);
    }
    return matrix;
}

/**
 * Creates a downloadable link for a Blob object with a specified filename.
 */
async function downloadExcel(workbook, filename) {
    buffer = await workbook.xlsx.writeBuffer();
    const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

/**
 * Download xls file and return first worksheet object
 */
async function downloadTemplate(url) {
    let response = await fetch(url);
    let arrayBuffer = await response.arrayBuffer();
    const workbook = new ExcelJS.Workbook();
    return await workbook.xlsx.load(arrayBuffer);
}

/**
 * Populates a worksheet with the value matrix
 * @param {*} workbook 
 * @param {*} data 
 * @param {*} start starting cell, e.g. A2
 * @param {*} sheet 
 */
function setSheetValues(worksheet, data, start) {
    const startCell = worksheet.getCell(start);
    let startRow = startCell.row;
    let startCol = startCell.col;
    for (let i = 0; i < data.length; i++) {
        for (let j = 0; j < data[i].length; j++) {
            const cell = worksheet.getRow(startRow + i).getCell(startCol + j);
            cell.value = data[i][j];
        }
    }
}

/**
 * Create onchange handler for file input
 */
function createOnchangeHandler(callback) {
    return (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            const data = new Uint8Array(e.target.result);
            const workbook = new ExcelJS.Workbook();
            workbook.xlsx.load(data).then(() => callback(workbook))
        };
        reader.readAsArrayBuffer(file);
    }
}