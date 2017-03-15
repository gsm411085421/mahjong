/**
 * 菜单 sessionStorage
 * @param  {[type]} $ [description]
 * @return {[type]}   [description]
 */
/*(function($){
  $('.sidebar-menu li a').on('click', function(event){
    var index = $(this).index('.sidebar-menu a')
    sessionStorage.menu_index = index;
  })
  if(sessionStorage.menu_index != undefined){
    $('.sidebar-menu .active').removeClass('active')
    var index = sessionStorage.menu_index
    var cur_menu = $('.sidebar-menu a').eq(index)
    cur_menu.parents('li').addClass('active');
    cur_menu.parents('.treeview').addClass('active')
    cur_menu.parents('.treeview-menu').addClass('menu-open')
  }
}(jQuery))*/

/**
 * 根据当前登录用户判断显示的菜单项
 * @param  {[type]} action 用户的权限
 * @return {[type]}        [description]
 */
function showMenu(action)
{
  if(action == 'whosyourdaddy'){
    // $('.hide').removeClass('hide');
  }else{
    for(var k in action){
        $('.'+action[k]).parents('.treeview').removeClass('hide');
        $('.'+action[k]).removeClass('hide');
    }
  }
}

/**
 * ajax 表单提交
 * @param  {[type]}   obj      [description]
 * @param  {Boolean}  reload   [description]
 * @param  {Boolean}  debug    [description]
 * @param  {Function} callback [description]
 * @return {[type]}            [description]
 */
function ajaxForm(obj, debug, callback)
{
  reload = reload || false;
  debug  = debug || false;
  var url  = $(obj).closest('form').attr('action')
  var data = $(obj).closest('form').serializeArray();

  $(obj).closest('form').submit(function(){return false});

  $.post(url, data, function(res){
    if(debug){
      console.info(res);return;
    }
    if(res.code){
      //close the modal 
      if($(obj).closest('.modal')){
        $(obj).closest('.modal').modal('hide')
      }
      bayMax.msg(res.msg, function(){
        if (typeof callback == 'function') {
          callback.call();
        }
      })
    }else{
      bayMax.warning(res.msg)
    }
  })
}

/** 图片上传 绑定到DOM click */
function upload_img(obj,uploadUrl){
    var fileTag = '<input type="file" name="image" id="upload_img_file" style="display: none;" >';
    $(fileTag).appendTo($('body'))
    $("#upload_img_file").click();
    $("#upload_img_file").change(function(fileDom){
        var file = $(fileDom.target)[0].files[0]
        if(file.size > 2*1024*1024){
            alert('图片太大了，不能超过2M');return ;
        }
        var form = new FormData();
        var xhr = new XMLHttpRequest();
        form.append('image', file);
        xhr.open('POST',uploadUrl)
        xhr.onreadystatechange = function(){
            if(this.readyState == 4){
                var info = this.responseText;
                info = JSON.parse(info);
                if(info.code == 0){
                    $(obj).html('<img src="'+info.data+'" style="max-width:100%;max-height:100%">')
                }else{
                    bayMax.msg(info.data);
                }
            }
        }
        xhr.send(form);
          $("#upload_img_file").remove();
    });
}
/**
 * datepicker 初始化
 * @param  object dom jQuery Dom
 * @return void
 */
function init_datepicker(dom, config)
{
  var param = {
    language : 'zh-CN',
    format: 'yyyy-mm-dd',
    autoclose: true
  };
  var setting = $.extend(param, config);
  dom.datepicker(setting);
}
/**
 * datetimepicker 初始化
 * @param  {object} $dom    jQuery对象
 * @param  {object} options 参数
 * @return {void}
 */
function init_datetimepicker($dom,options){
    var settings = $.extend({
        'language' : 'zh-CN',
        'weekStart' : 1,
        'autoclose' : true,
        'minView'  : 'hour',
        'todayHighlight' : true,
    },options);
    $dom.datetimepicker(settings);
}

/**
 * 初始化 iCheck
 * @param  {object} dom    jQuery Dom
 * @param  {Object} config [description]
 * @return void
 */
function init_icheck(dom, config)
{
  var param = {
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green'
  };
  var setting = $.extend(param, config);
  dom.iCheck(setting);
}
/**
 * [item_status description]
 * @param  {[type]} obj   [description]
 * @param  {[type]} id    [description]
 * @param  {[type]} table [description]
 * @param  {[type]} value [description]
 * @return {[type]}       [description]
 */
function item_status(obj, id, table, value)
{
  $.post('setStatus.html',{table:table,id:id,value:value},
      function(){
          if(value){
              $(obj).parent().html('<span class="label label-success" onclick="item_status(this,'+id+',\''+table+'\',0)" style="cursor:pointer" data-toggle="tooltip" data-placement="bottom" data-title="点击关闭">开启</span>');
          }else{
              $(obj).parent().html('<span class="label label-default" onclick="item_status(this,'+id+',\''+table+'\',1)" style="cursor:pointer" data-toggle="tooltip" data-placement="bottom" data-title="点击开启">关闭</span>');
          }
      });
}

var bayMax = {
  /**
   * 插件集
   */
  /**
   * 模态框
   * 基于 jQuery confirm 插件
   */
  /** 确定删除 询问 */
  deleteConfirm : function(callback){
    $.confirm({
        title : '删除？',
        content : '确定要删除吗？',
        type : 'red',
        icon: 'fa fa-warning',
        buttons : {
            yes : {
                text : '确定',
                btnClass : 'btn-red',
                keys : ['enter'],
                action : function(){
                    if(typeof callback == 'function')
                        callback.call();
                }
            },
            no : {
                text : '取消',
            }
        },
    })
  }, // ./end of deleteConfrim 

  /** 提示 普通信息提示 */
  msg : function(msg,callback){
    var _msg = msg || '提示'
    $.alert({
      title : false,
      type : 'dark',
      content : _msg,
      buttons : {
        ok : {
          text : 'OK',
          action : function(){
            if(typeof callback === 'function'){
              callback()
            }
          },
        }
      }
    })
  },
/** 警告框 */
  warning : function(info, wait){
    wait = wait || 2000;
    var _info = info || '警告信息'
    var _autoClose = 'close|'+wait
    $.alert({
      title : '警告',
      type : 'red',
      icon : 'fa fa-warning',
      content : _info,
      autoClose : _autoClose,
      buttons : {
        close : {
          text : '关闭',
        }
      }
    })
  },

  _validatePlugin : function(){
    if(typeof $.alert == 'undefined'){
      throw '插件未引入';
    }
  },
};

/**
 * 选择省份和城市
 * @param  {[type]} obj [description]
 * @return {[type]}     [description]
 */
function inputCity(obj)
{
  var str = `<div class="modal fade" id="modal-ztree">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">选择城市</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <ul id="tree-node" class="ztree"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
  $(obj).parent().append(str);
  $('#modal-ztree').modal('show');
  var setting = {
    async : {
        enable: true,
        url: "/data/provincesCities.json",
        autoParam: ["id","name",'level','pid'],
    },
    callback:{
        onClick:function(event, treeID, treeNode){
          var treeObj = $.fn.zTree.getZTreeObj(treeID);
          var nodes = treeObj.getSelectedNodes();
            $(obj).val(nodes[0].name);
            $('#modal-ztree').modal('hide');
            $('#modal-ztree').siblings('#modal-ztree').remove();
        }
    },
  };
  var zTreeObj;
  var zNodes = null;
  zTreeObj = $.fn.zTree.init($("#tree-node"), setting, zNodes);
}
/**
 * layer iframe 子窗口
 * @param  selector 选择器 不能是ID选择器
 * @return {[type]}     [description]
 */
function winIframe(selector, checkStyle = 'radio', checkedUser='')
{
    selector = encodeURIComponent(selector);
    layer.open({
        type: 2,
        title: '选择员工',
        shadeClose: true,
        shade: 0.8,
        area: ['30%', '90%'],
        content: '/api/companymember.html?obj='+selector+'&checkStyle='+checkStyle+'&checkedUser='+checkedUser
    });
}

/**
 * 公司成员 复选框
 * @param  {string} selector    选择器
 * @param  {string} checkedUser 默认选择的用户 以','连接
 * @return {[type]}             [description]
 */
function checkbox_subwin(selector, checkedUser)
{
  winIframe(selector, 'checkbox', checkedUser);
}

/**
 * 选择公司部门
 * @param  {[type]} selector    选择器
 * @param  {[type]} checkedUser 传入默认选择的部门id
 * @return {[type]}             [description]
 */
function company_department(selector, checkedUser)
{
    selector = encodeURIComponent(selector);
    layer.open({
        type: 2,
        title: '选择部门',
        shadeClose: true,
        shade: 0.8,
        area: ['30%', '90%'],
        content: '/api/companydepartment.html?selector='+selector+'&checkedUser='+checkedUser
    });
}

/**
 * 允许使用的用户组
 * @param  {[type]} selector 选择器
 * @param  {[type]} id       默认选择的用户组ID
 * @return {[type]}          [description]
 */
function allow_group(selector, id)
{
    selector = encodeURIComponent(selector);
    layer.open({
        type: 2,
        title: '允许使用的用户组',
        shadeClose: true,
        shade: 0.8,
        area: ['50%', '40%'],
        content: '/api/allowgroup.html?selector='+selector+'&id='+id
    });
}