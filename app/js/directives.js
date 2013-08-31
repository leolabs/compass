compassMain.directive('lang', function(){
    return {
        restrict: 'E',
        replace: true,
        link: function(scope, elm, attrs){
            var content = elm.html();
            if(scope.appSettings.debug) console.log(content);

            if(i18n[scope.appSettings.lang].hasOwnProperty(content)){
                elm.html(i18n[scope.appSettings.lang][content]);
            }
        }
    }
});