const updatePath = (e, n) => {
    var url = new URL(window.location.href);
    console.log('url', url);
    window.location.replace(url.origin + url.pathname + '?' + n + '=' + e.value);
}