<?php
SyL_Loader::fw('Adm.Flow.Upd');

/**
 * AdmFormsEl_authorityフォーム更新クラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class Authority_Upd extends SyL_AdmFlowUpd
{
    /**
     * アクションフォームクラス名
     *
     * @access protected
     * @var string
     */
    var $classname = 'Adm.Forms.El_authority';

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
