compassMain.filter('domainName', function() {
    return function(uri) {
        var parsedURI = parseUri(uri);
        return parsedURI.host;
    }
});

compassMain.filter('decryptAES',  function() {
    return function(encrypted, protect){
        var decrypted = "";

        try{
            decrypted = sjcl.decrypt(password, encrypted);
        }catch(exception){
            if(protect){
                var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
                var string_length = Math.random() * 16 + 16;
                decrypted = '';
                for (var i=0; i<string_length; i++) {
                    var rnum = Math.floor(Math.random() * chars.length);
                    decrypted += chars.substring(rnum,rnum+1);
                }
            }else{
                decrypted = "invalid";
            }
        }

        return decrypted;
    }
});

compassMain.filter('lang', function() {
    return function(key, scope){
        if(i18n[scope.appSettings.lang].hasOwnProperty(key)){
            return i18n[scope.appSettings.lang][key];
        }else{
            return key;
        }
    }
});