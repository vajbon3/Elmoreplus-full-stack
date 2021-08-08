// boolean for positioning only once
positioned = false;

// notifications container
let container = document.querySelector("#notifications");

// notification button
let notificationButton = document.querySelector("#notification-button");

function toggle(e) {
    container.classList.contains("invisible") ?
        container.classList.remove("invisible") : container.classList.add("invisible");
}

notificationButton.onclick = function(e) {
    if(!positioned) {
        positionPopupOnPage(e);
        positioned = true;
    }

    toggle(e);
}

function positionPopupOnPage( evt ) {

    var VPWH = [];                  // view port width / height
    var intVPW, intVPH;             // view port width / height
    var intCoordX = evt.clientX;
    var intCoordY = evt.clientY;    // distance from click point to view port top
    var intDistanceScrolledUp = document.body.scrollTop;
    // distance the page has been scrolled up from view port top
    var intPopupOffsetTop = intDistanceScrolledUp + intCoordY;
    // add the two for total distance from click point y to top of page

    var intDistanceScrolledLeft = document.body.scrollLeft;
    var intPopupOffsetLeft = intDistanceScrolledLeft + intCoordX;

    VPWH = getViewport();    // view port Width/Height
    intVPW = VPWH[0];
    intVPH = VPWH[1];
    container.style.display = "block";
    // if not display: block, .offsetWidth & .offsetHeight === 0
    container.style.zIndex = '10100';

    if ( intCoordX > intVPW/2 ) { intPopupOffsetLeft -= container.offsetWidth; }
    // if x is in the right half of the viewport, pull popup left by its width
    if ( intCoordY > intVPH/2 ) { intPopupOffsetTop -= container.offsetHeight; }
    // if y is in the bottom half of view port, pull popup up by its height

    container.style.top = intPopupOffsetTop + 20 + 'px';
    container.style.left = intPopupOffsetLeft + 'px';
}

function getViewport() {

    var viewPortWidth;
    var viewPortHeight;

    // the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
    if (typeof window.innerWidth != 'undefined') {
        viewPortWidth = window.innerWidth,
            viewPortHeight = window.innerHeight
    }

// IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)
    else if (typeof document.documentElement != 'undefined'
        && typeof document.documentElement.clientWidth !=
        'undefined' && document.documentElement.clientWidth != 0) {
        viewPortWidth = document.documentElement.clientWidth,
            viewPortHeight = document.documentElement.clientHeight
    }

    // older versions of IE
    else {
        viewPortWidth = document.getElementsByTagName('body')[0].clientWidth,
            viewPortHeight = document.getElementsByTagName('body')[0].clientHeight
    }
    return [viewPortWidth, viewPortHeight];
}
