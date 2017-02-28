<?php
/**
 * AQUARIMユーザードメインマネージャクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLManagerUser extends EuryLManager
{
    /**
     * DAOクラス
     *
     * @access protected
     * @var object
     */
    //var $dao_classname = 'EuryL.Dao.User';

    /**
     * 既にユーザーIDが登録されてるかチェックする
     *
     * @access public
     * @param object ユーザーオブジェクト
     * @return bool true: 既登録、false: 未登録
     */
    function existsUser(&$user_data)
    {
        $user_table = EuryLManager::createTable('el_user');
        $condition = $this->dao->createCondition();
        $condition->addEqual('LOGIN_ID', $user_data->login_id);
        $user_table->setConditions($condition);
        $result = $this->dao->select($user_table);
        return (count($result) > 0);
    }

    /**
     * ユーザーデータを取得する
     *
     * @access public
     * @param object ユーザーオブジェクト
     * @return object ユーザーオブジェクト
     */
    function getUser(&$user_data)
    {
        $user_table = EuryLManager::createTable('el_user');
        $condition = $this->dao->createCondition();
        $condition->addEqual('LOGIN_ID', $user_data->login_id);
        $condition->addEqual('LOGIN_PASSWD', $user_data->login_passwd);
        $condition->addEqual('ENABLE_FLAG', '1');
        $user_table->setConditions($condition);
        $result = $this->dao->select($user_table);
        if (count($result) > 0) {
            $user_data->login_passwd = null;
            $user_data->id    = $result[0]['USER_ID'];
            $user_data->name  = $result[0]['USER_NAME'];
            $user_data->email = $result[0]['EMAIL'];
            $user_data->create_date = $result[0]['CREATE_DATE'];
            $user_data->update_date = $result[0]['UPDATE_DATE'];
            return $user_data;
        } else {
            return null;
        }
    }

    /**
     * ユーザーデータを取得する
     *
     * @access public
     * @param object ユーザーオブジェクト
     * @return object ユーザーオブジェクト
     */
    function addUser(&$user_data)
    {
        $current_date = date('Y-m-d H:i:s');

        $user_table = EuryLManager::createTable('el_user');
        $user_table->set('USER_NAME', $user_data->name);
        $user_table->set('LOGIN_ID', $user_data->login_id);
        $user_table->set('LOGIN_PASSWD', $user_data->login_passwd);
        $user_table->set('EMAIL', $user_data->email);
        $user_table->set('ENABLE_FLAG', '1');
        $user_table->set('CREATE_DATE', $current_date);
        $user_table->set('UPDATE_DATE', $current_date);
        $this->dao->insert($user_table);
    }

    /**
     * ユーザーデータを更新する
     *
     * @access public
     * @param object ユーザーオブジェクト
     */
    function modifyUser(&$user_data)
    {
        $current_date = date('Y-m-d H:i:s');

        $user_table = EuryLManager::createTable('el_user');
        $user_table->set('USER_NAME', $user_data->name);
        $user_table->set('LOGIN_PASSWD', $user_data->login_passwd);
        $user_table->set('EMAIL', $user_data->email);
        $user_table->set('UPDATE_DATE', $current_date);
        $condition = $this->dao->createCondition();
        $condition->addEqual('USER_ID', $user_data->id);
        $user_table->setConditions($condition);
        $this->dao->update($user_table);
    }


    /**
     * ユーザーデータを履歴に登録する
     *
     * @access public
     * @param object ユーザーオブジェクト
     * @param string アクション名
     */
    function addUserHistory(&$user_data, $action_name)
    {
        $user_history_table = EuryLManager::createTable('el_user_history');
        $user_history_table->set('LOGIN_ID', $user_data->login_id);
        $user_history_table->set('ACTION_NAME', $action_name);
        $user_history_table->set('IP_ADDRESS', isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null);
        $user_history_table->set('DOMAIN', null);
        $user_history_table->set('USER_AGENT', isset($_SERVER['HTTP_USER_AGENT']) ? substr($_SERVER['HTTP_USER_AGENT'], 0, 250) : null);
        $user_history_table->set('ACTION_DATE', date('Y-m-d H:i:s'));
        $this->dao->insert($user_history_table);
    }

}

?>
