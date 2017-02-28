<?php
/**
 * サイトドメインマネージャクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLManagerSite extends EuryLManager
{
    /**
     * キャッシュの接頭辞
     *
     * @access protected
     * @var string
     */
    var $cache_prefix = 'site.';

    /**
     * ユーザーデータを取得する
     *
     * @access public
     * @param object コンテキストオブジェクト
     * @return object アプリケーションオブジェクト
     */
    function getApplication(&$context)
    {
        $domain_name = $context->getServerName();
        $application_dir_name = SYL_APP_NAME;

        $cache_key = $domain_name . $application_dir_name;
        $cache = $context->getCache($cache_key, $this->cache_prefix);
        if ($cache) {
            return $cache;
        } else {
            $application_data = EuryLManager::createData('application');
            $application_data->domain_name = $domain_name;
            $application_data->application_dir_name = $application_dir_name;

            $site_table = EuryLManager::createTable('el_site');
            //$site_table->setDefaultAll(false);
            $condition = $this->dao->createCondition();
            $condition->addEqual('DOMAIN_NAME', $application_data->domain_name);
            $site_table->setConditions($condition);

            $application_table = EuryLManager::createTable('el_application');
            $condition = $this->dao->createCondition();
            $condition->addEqual('APPLICATION_DIR_NAME', $application_data->application_dir_name);
            $application_table->setConditions($condition);

            $reration = $this->dao->createRelation();
            $reration->addInnerJoin($site_table, $application_table, array($site_table->getAliasName() . '.SITE_ID = ' . $application_table->getAliasName() . '.SITE_ID'));

            $result = $this->dao->select(array($site_table, $application_table), $reration);
            if (count($result) > 0) {
                $application_data->site_id     = $result[0]['SITE_ID'];
                $application_data->site_name   = $result[0]['SITE_NAME'];
                $application_data->application_id   = $result[0]['APPLICATION_ID'];
                $application_data->application_name = $result[0]['APPLICATION_NAME'];
                $application_data->title       = $result[0]['DEFAULT_TITLE'];
                $application_data->keywords    = $result[0]['DEFAULT_KEYWORDS'];
                $application_data->description = $result[0]['DEFAULT_DESCRIPTION'];
                $application_data->headers     = $result[0]['HEADERS'];
                $context->setCache($cache_key, $application_data, $this->cache_prefix);
                return $application_data;
            } else {
                return null;
            }
        }

    }

}

?>
