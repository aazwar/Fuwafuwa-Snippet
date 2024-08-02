// write TOC
document.write(`
<nav class="toc" style="height: 90vh; overflow-y: auto">
  <ul>
    <li><a href="index.html#intro">Fuwafuwa Framework</a>
      <ul>
        <li><a href="index.html#requirements">Server Requirements</a></li>
        <li><a href="license.html#license">License</a></li>
      </ul>
    </li>
    <li><a href="installation.html#installation">Installation</a>
      <ul>
        <li><a href="installation.html#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="overview.html#overview">Overview</a>
      <ul>
        <li><a href="overview.html#structure">Application Structure</a></li>
        <li><a href="mvc.html#mvc">Model, View &amp; Controllers</a></li>
      </ul>
    </li>
    <li><a href="models.html#models">Models</a>
      <ul>
        <li><a href="models.html#creating_model">Creating Model</a></li>
        <li><a href="models.html#model_configuration">Model Configuration</a></li>
        <li><a href="models.html#working_with_data">Working with Data</a></li>
      </ul>
    </li>
    <li><a href="controllers.html#controllers_routing">Controllers &amp; Routing</a>
      <ul>
        <li><a href="controllers.html#routing">Routing</a></li>
        <li><a href="controllers.html#controllers">Controllers</a></li>
        <li><a href="controllers.html#authentication">Authentication</a></li>
        <li><a href="controllers.html#authorization">Authorization</a></li>
        <li><a href="controllers.html#sql">Model & SQL</a></li>
        <li><a href="controllers.html#ajax">Ajax</a></li>
        <li><a href="controllers.html#api">API</a></li>
        <li><a href="controllers.html#cli">CLI</a></li>
      </ul>
    </li>
    <li><a href="views.html#views">Views</a>
      <ul>
        <li><a href="views.html#view_format">View Format</a></li>
        <li><a href="views.html#themes">Themes</a></li>
        <li><a href="i18n.html#i18n">I18n</a></li>
      </ul>
    </li>
    <li><a href="building.html#building">Building Application</a>
      <ul>
        <li><a href="building.html#static">Static</a></li>
        <li><a href="building.html#dynamic">Dynamic</a></li>
        <li><a href="fftable.html#fftable">FFTable <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Flagship</span>
</a></li>
        <li><a href="simple-table.html#simple-table">Simple Table</a></li>
        <li><a href="widgets.html#widgets">Widgets</a></li>
      </ul>
    </li>
    <li><a href="examples.html#examples">Examples</a>
    </li>
    <li><a href="api/">API</a>
    </li>
    <li><a href="/">Home</a>
    </li>
  </ul>
  <svg class="toc-marker" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
    <path stroke="#444" stroke-width="3" fill="transparent" stroke-linecap="round"
    stroke-linejoin="round" transform="translate(-0.5, -0.5)" />
  </svg>
</nav>
`);

// Hakim El Hattab (https://lab.hakim.se/progress-nav/)
var toc = document.querySelector('.toc');
var tocPath = document.querySelector('.toc-marker path');
var tocItems;

// Factor of screen size that the element must cross
// before it's considered visible
var TOP_MARGIN = 0.1,
    BOTTOM_MARGIN = 0.2;

var pathLength;

var lastPathStart,
    lastPathEnd;

window.addEventListener('resize', drawPath, false);
window.addEventListener('scroll', sync, false);

setTimeout(() => {
    drawPath();
    document.querySelector('.visible').scrollIntoView();
}, 100);

function drawPath() {

    tocItems = [].slice.call(toc.querySelectorAll('li'));

    // Cache element references and measurements
    tocItems = tocItems.map(function (item) {
        var anchor = item.querySelector('a');
        var target = document.getElementById(anchor.getAttribute('href').replace(/^.*#/, ''));

        return {
            listItem: item,
            anchor: anchor,
            target: target
        };
    });

    // Remove missing targets
    tocItems = tocItems.filter(function (item) {
        return !!item.target;
    });

    var path = [];
    var pathIndent;

    tocItems?.forEach(function (item, i) {

        var x = item.anchor.offsetLeft - 5,
            y = item.anchor.offsetTop,
            height = item.anchor.offsetHeight;

        if (i === 0) {
            path.push('M', x, y, 'L', x, y + height);
            item.pathStart = 0;
        }
        else {
            // Draw an additional line when there's a change in
            // indent levels
            if (pathIndent !== x) path.push('L', pathIndent, y);

            path.push('L', x, y);

            // Set the current path so that we can measure it
            tocPath.setAttribute('d', path.join(' '));
            item.pathStart = tocPath.getTotalLength() || 0;

            path.push('L', x, y + height);
        }

        pathIndent = x;

        tocPath.setAttribute('d', path.join(' '));
        item.pathEnd = tocPath.getTotalLength();

    });

    pathLength = tocPath.getTotalLength();

    sync();

}

function sync() {

    var windowHeight = window.innerHeight;

    var pathStart = pathLength,
        pathEnd = 0;

    var visibleItems = 0;

    tocItems?.forEach(function (item) {

        var targetBounds = item.target.getBoundingClientRect();

        if (targetBounds.bottom > windowHeight * TOP_MARGIN && targetBounds.top < windowHeight * (1 - BOTTOM_MARGIN)) {
            pathStart = Math.min(item.pathStart, pathStart);
            pathEnd = Math.max(item.pathEnd, pathEnd);

            visibleItems += 1;

            item.listItem.classList.add('visible');
        }
        else {
            item.listItem.classList.remove('visible');
        }

    });

    // Specify the visible path or hide the path altogether
    // if there are no visible items
    if (visibleItems > 0 && pathStart < pathEnd) {
        if (pathStart !== lastPathStart || pathEnd !== lastPathEnd) {
            tocPath.setAttribute('stroke-dashoffset', '1');
            tocPath.setAttribute('stroke-dasharray', '1, ' + pathStart + ', ' + (pathEnd - pathStart) + ', ' + pathLength);
            tocPath.setAttribute('opacity', 1);
        }
    }
    else {
        tocPath.setAttribute('opacity', 0);
    }

    lastPathStart = pathStart;
    lastPathEnd = pathEnd;

}

