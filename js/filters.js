compassMain.filter('domainName', function() {
    return function(uri) {
        var parsedURI = parseUri(uri);
        return parsedURI.host;
    }
})