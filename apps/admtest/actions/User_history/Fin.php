<?php
SyL_Loader::fw('Adm.Flow.Fin');

/**
 * AdmFormsEl_user_historyフォーム完了表示クラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class User_history_Fin extends SyL_AdmFlowFin
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'Adm.Forms.El_user_history';

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
