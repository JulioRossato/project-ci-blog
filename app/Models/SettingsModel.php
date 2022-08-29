<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of SettingModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class SettingsModel extends Model
{
    protected $table          = 'Settings';
    protected $primaryKey     = 'id';
    protected $allowedFields  = [
        'variable',
        'value',
    ];
    protected $returnType     = \App\Entities\Settings::class;
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $createdField   = 'createdAt';
    protected $updatedField   = 'updatedAt';
    protected $deletedField   = 'deletedAt';

    public function updateWebSettings($post)
    {
        $post['shipping_mode']        = (!empty($post['shipping_mode'])) ?: 0;
        $post['return_mode']          = (!empty($post['return_mode'])) ?: 0;
        $post['support_mode']         = (!empty($post['support_mode'])) ?: 0;
        $post['safety_security_mode'] = (!empty($post['safety_security_mode'])) ?: 0;
        $system_data                  = json_encode($post, JSON_PRETTY_PRINT);

        $web_settings = $this->where('variable', 'web_setting')->asArray()->find();

        if (count($web_settings) === 0) {
            $data = array(
                'variable' => 'web_setting',
                'value'    => $system_data
            );
            return $this->save($data);
        } else {
            $data = array(
                'variable' => 'web_setting',
                'value'    => $system_data
            );

            return $this->set($data)
                    ->where('variable', 'web_setting')
                    ->update();
        }
    }
}