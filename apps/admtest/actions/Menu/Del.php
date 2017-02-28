<?php
SyL_Loader::fw('Adm.Flow.Del');

/**
 * AdmFormsEl_menuフォーム削除クラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class Menu_Del extends SyL_AdmFlowDel
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'Adm.Forms.El_menu';

    /**
     * デフォルトアクション処理
     *
     * @access public
     * @param object データ管理オブジェクト
     * @param object コンテキスト管理オブジェクト
     */
    function execute(&$data, &$context)
    {
        parent::execute($data, $context);
    }
}
