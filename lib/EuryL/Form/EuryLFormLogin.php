<?php
/**
 * EuryL ログインフォームクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2008 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLFormLogin extends SyL_ActionForm
{
    var $elements_config = array(
        'login_id' => array(
            'type' => 'text',
            'name' => 'ログインID',
            'attributes'   => array('size' => '30'),
        ),
        'login_passwd' => array(
            'type'  => 'password',
            'name' => 'パスワード',
            'attributes'   => array('size' => '30'),
        ),

    );
}

?>
