(function(){

  tinymce.PluginManager.requireLangPack('yahman_addons_notice_plugin', 'ja');
  tinymce.create('tinymce.plugins.YAHMAN_Addons_NoticeBox', {
    init: function(ed, url){

      ed.addButton('yahman_addons_notice_list', {
        title: 'YAHMAN Add-ons Notice Box',
        text: 'Notice BOX',
        type: 'listbox',
        values: [
          {text: 'info', value: 'info', style:'background:#dceaea' },
          {text: 'Success', value: 'success', style:'background:#bed8be'},
          {text: 'Warning', value: 'warning', style: 'background:#f9e4a5'},
          {text: 'Danger', value: 'danger', style: 'background:#efa882'},
          {value: 'none',style: 'display:none'}
        ],
        value:'none',
        onselect:  function(e) {
          var selectedText = ed.selection.getContent({format: 'html'});
          var word = '<div class="ya_notice ya_' + this.value() + ' shadow_box">'+ selectedText +'</div>';
          tinyMCE.execCommand('mceInsertContent',false,word);
                //editor.insertContent(this.value());

        },

      });

    },
    getInfo: function() {
      return {
        longname : 'YAHMAN Add-ons Notice Box',
        author : 'YAHMAN',
        authorurl : 'https://back2nature.jp',
        version : "0.0.1"
      };
    }
  });
  tinymce.PluginManager.add( 'yahman_addons_notice_plugin', tinymce.plugins.YAHMAN_Addons_NoticeBox );
})();