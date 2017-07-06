//这里的js, 可以做为一个外部的JS文件, 然后由上面这些页面统一引入即可.
(function(){
    var tDiv = document.getElementById("nav_bar"),
        links = tDiv.getElementsByTagName("a"),
        index = 0,//默认第一个菜单项
        url = location.href.split('?')[0].split('/').pop();//取当前URL最后一个 / 后面的文件名，pop方法是删除最后一个元素并返回最后一个元素

    if(url){//如果有取到, 则进行匹配, 否则默认为首页(即index的值所指向的那个)
        for (var i=links.length; i--;) {//遍历 menu 的中连接地址
            if(links[i].href.indexOf(url) !== -1){
                index = i;
                break;
            }
        }
    }

    links[index].className = 'nav_active';
})();
