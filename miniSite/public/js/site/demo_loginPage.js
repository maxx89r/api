window.onload = initPage;

/* 初始化页面 */
function initPage(){
    jCf.initXHttp();
}

/** 
 * 登录网站
 */
function login(oForm) {
    var postData = jCf.makeFormPostData(oForm);
    jCf.asyncSubmit(oForm.action, postData, 'handleLogin');
}
/** 
 * 处理登录网站返回
 */
function handleLogin() {
    if (jCf.asyncSubmitOk()) {
        jCf.makeAjaxRsp();
        if (jCf.ajaxRsp) {
            if (jCf.ajaxRsp.status == jCv.ERR_INFO) {
                jCf.redirectByAjaxRsp();
            } else {
                jCf.dlg({'message':jCf.ajaxRsp.info, 'displayTime':1000});
            }
        } else {
            jCf.dlg({'message':jCv.info['cm_program_error']});
        }
        
        /*
        jCf.dlg({'message':jCf.ajaxRsp.status});
        jCf.dlg({'message':jCf.ajaxRsp.info});
        jCf.dlg({'message':jCf.ajaxRsp.redirectUrl});
        jCf.dlg({'message':jCf.ajaxRsp.redirectTarget});
        jCf.dlg({'message':jCf.ajaxRsp.returnData});
        */
    }
}

/**
 * 按回车键登录
 */
function keyDownLogin(e){
    e = (e) ? e : ((window.event) ? window.event : "");
    var key = e.keyCode?e.keyCode:(e.which? e.which : e.charCode);
    if(key==13){
        login(jCf.$('formLogin'));
    }
}