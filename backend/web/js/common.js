/**
 * 公用数据操作方法
 * @author 飞鹰007(371339893@qq.com)
 * @param string request_type 请求协议名 get post 
 * @param string csrf 防跨站攻击安全码 
 * @param string url
 * @param string confirm_msg 弹窗显示信息内容
 * @param string ele_name 元素名 
 * @param string ele_type 元素类型 如 input select textarea等
 * @param string ele_action 元素的状态 如 selected checked
 * @param boolean is_jumptourl default false 是否跳转到url 启用这个，后面的都无效
 * @param boolean is_view_doc 是否查看文档 
 * @param boolean is_show_modal 是否用bootstraps的模态窗口，如果不启用则用noty alter
 * @param boolean is_refresh default true 是否重载页面
 * @returns {Boolean}
 */
function commonDataOperate(request_type,csrf,url,confirm_msg,ele_name,ele_type,ele_action,is_jumptourl,is_view_doc,is_show_modal,is_refresh){
    if(typeof(is_jumptourl)=="undefined"){
        var is_jumptourl=false;
    }
    if(typeof(is_view_doc)=="undefined"){
        var is_view_doc=false;
    }
    if(typeof(is_show_modal)=="undefined"){
        var is_show_modal=false;
    }
    if(typeof(is_refresh)=="undefined"){
        var is_refresh=true;
    }    
    if(typeof(request_type)=="undefined"){
        var request_type=$.post;
    }else{
        if(request_type=='get'){
            var request_type=$.get;
        }else{
            var request_type=$.post;
        }
    }
    
    if(typeof(csrf)=="undefined"){
        var csrf='';
    }
    checked_result=checkedEle(ele_name,ele_type,ele_action);
    if(checked_result.length<=0 && is_jumptourl<2){
        alert('您未勾选要执行的ID');
        return false;
    }    
    
    if ((is_view_doc || is_jumptourl || url.indexOf("update")>0) && checked_result.indexOf(",") >= 1) {
        if (is_show_modal) {
            $(".modal-title").text('提示');
            $(".modal-body").text('请只勾选一个ID');
            $('#myModal').modal();
            if (is_refresh) {
                $('#myModal').on('hidden.bs.modal', function () {
                    window.location.reload();
                });
            }
        } else {
            noty({text: '提示，请只勾选一个ID', layout: "center",type:'warning', timeout: 5000});
            if (is_refresh) {
                window.location.reload();
            }
        }
        return false;
    }
    if(is_jumptourl){
        window.location.href=url+"&id="+checked_result;
        return false;
    }
    if(checked_result.length>0){
        if(confirm_msg===""){
            var params = {id: checked_result,_csrf:csrf};
            request_type(url, params, function (result) {
                var obj = eval('(' + result + ')');
                var msg='';
                var title='提示';
                if (obj.status === 1) {
                    msg=obj.data.content;
                    title=obj.data.title;
                }else{
                    msg=obj.msg;
                }
                if (is_show_modal) {
                    $(".modal-title").text(title);
                    $(".modal-body").html(msg);
                    $('#myModal').modal();
                    if (is_refresh) {
                        $('#myModal').on('hidden.bs.modal', function () {
                            window.location.reload();
                        });
                    }
                } else {
                    noty({text: obj.msg, layout: "center", type: "success", timeout: 5000});
                    if (is_refresh) {
                        window.location.reload();
                    }
                }
            });
        }else{
            if(confirm(confirm_msg)){
                var params={id:checked_result,_csrf:csrf};            
                request_type(url,params,function(result){
                    if(result===''){
                        noty({text: '操作成功', layout: "center", type: "success", timeout: 5000});
                        //window.location.reload();
                        return;
                    }
                    var obj=eval('(' + result + ')');                    
                    var msg='';
                    var title='提示';
                    if (obj.status === 1) {
                        msg=obj.data.content;
                        title=obj.data.title;
                    }else{
                        msg=obj.msg;
                    }
                    if (is_show_modal) {
                        $(".modal-title").text(title);
                        $(".modal-body").html(msg);
                        $('#myModal').modal();
                        if (is_refresh) {
                            $('#myModal').on('hidden.bs.modal', function () {
                                window.location.reload();
                            });
                        }
                    } else {
                        noty({text: obj.msg, layout: "center", type: "success", timeout: 5000});
                        if (is_refresh) {
                            window.location.reload();
                        }
                    }
                });
            }
        }
    }
}


function checkedEle(ele,ele_type,do_action){
    has_value='';
    $(ele_type+'[name="'+ele+'"]:'+do_action).each(function(i,ele){
        has_value+=$(this).val()+",";
    });
    if(has_value!==""){
        has_value=has_value.substr(0,has_value.length-1);
    }
    return has_value;
}

function addMore(ele,search_sub_ele,num){
    if(typeof(ele)=="undefined"){
        return false;
    }
    if(typeof(num)=="undefined"){
        var num=1;
    }
    if(typeof(search_sub_ele)=="undefined"){
        var search_sub_ele='';
    }

        for(var i=0;i<num;i++){
            if(search_sub_ele!=""){
                $("#"+ele).append($("#"+ele).find($("."+search_sub_ele)).eq(0).clone(true)); 
            }
        }
}

function SendMessage(url,csrf){
    if(typeof(url)=="undefined" || typeof(url)=="undefined"){
        noty({text: "参数url或csrf错误", layout: "center", type: "error", timeout: 2000});
        return false;
    }
    var formdiv='<form id="message-form" action="'+url+'" method="post" role="form">';
        formdiv+='<input name="_csrf-backend" value="'+csrf+'" type="hidden"><div class="field-message-username required">';
        formdiv+='<div><label class="control-label" for="message-receiver_id">用户名：</label><label class="text-warning"></label><input id="message-receiver_id" class="form-control" name="MessageModel[receiver_id]" aria-required="true" type="text"></div>';
        formdiv+='</div><div class="field-message-title required">';
        formdiv+='<div><label class="control-label" for="message-title">标题：</label><label class="text-warning"></label><input id="message-title" class="form-control" name="MessageModel[title]" aria-required="true" type="text"></div>';
        formdiv+='</div><div class="field-message-content required">';
        formdiv+='<div><label class="control-label" for="message-content">内容：</label><label class="text-warning"></label><input id="message-content" class="form-control" name="MessageModel[content]" aria-required="true" type="text"></div>';
        formdiv+='</div><div class="form-actions"><button type="submit" class="btn btn-success">确定</button></div></form>';
    $(".modal-title").text('发送消息');
    $(".modal-body").html(formdiv);
    $('#myModal').modal();
}

function LoanUnqualified(url,csrf,formname){
    if(typeof(url)=="undefined" || typeof(url)=="undefined" || typeof(formname)=="undefined"){
        noty({text: "参数url或csrf或表单模型名错误", layout: "center", type: "error", timeout: 2000});
        return false;
    }
    checked_result=checkedEle('selection[]','input','checked');
    if(checked_result.length<=0){
        alert('您未勾选要执行的ID');
        return false;
    } 
    if(checked_result.indexOf(",") >= 1){
        alert('请只勾选 一个ID');
        return false;
    }
    var id=checked_result;
    var formdiv='<form id="message-form" action="'+url+'&id='+id+'" method="post" role="form">';
        formdiv+='<input name="_csrf-backend" value="'+csrf+'" type="hidden"><input name="'+formname+'[id]" value="'+id+'" type="hidden"><input name="'+formname+'[status]" value="4" type="hidden"><div class="field-loans-remark required">';
        formdiv+='<div><label class="control-label" for="loans-reamrk">风控意见：</label><label class="text-warning"></label><textarea id="loans-remark" class="form-control" name="'+formname+'[remark]" aria-required="true"></textarea></div>';
        
        formdiv+='</div><div class="form-actions"><button type="submit" class="btn btn-success">确定</button></div></form>';
    $(".modal-title").text('风控意见');
    $(".modal-body").html(formdiv);
    $('#myModal').modal();
}

function UploadImage(model_name,url,model_data){
    if(typeof(model_name)=="undefined"){
        var model_name='';
    }
    if(typeof(url)=="undefined"){
        noty({text: 'url不能为空', layout: "center", type: "error", timeout: 5000});
    }
    if(typeof(model_data)=="undefined"){
        var model_data='';
    }
    $.post(url,{},function(result){
        var obj=eval('('+result+')');
        if(obj.status==0){
            noty({text: obj.msg, layout: "center", type: "error", timeout: 3000});
        }else{
            
        }
    });
}