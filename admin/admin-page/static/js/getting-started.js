/*
* @Author: 大胡子
* @Email:  dq@dqtheme.com
* @Link:   www.dq.me
* @Date:   2021-01-03 14:10:36
* @Last Modified by:   dq
* @Last Modified time: 2021-01-03 14:11:45
*/

/** --------------------------------------------------------------------------------- *
 *  TAB切换
 *  --------------------------------------------------------------------------------- */
jQuery('.inline-list').each(function () {
    jQuery(this)
        .find('li')
        .each(function (i) {
            jQuery(this).click(function (e) {

                if ('dq-blocks-panel-li' == jQuery(this).attr('id')) {
                    jQuery('.panel-right').css('display', 'none');
                }else{
                    jQuery('.panel-right').css('display', 'block');
                }
                
                jQuery(this)
                    .addClass('current')
                    .siblings()
                    .removeClass('current')
                    .parents('#wpbody')
                    .find('div.panel-left')
                    .removeClass('visible')
                    .end()
                    .find('div.panel-left:eq(' + i + ')')
                    .addClass('visible');
                return false;
            });
        });
});