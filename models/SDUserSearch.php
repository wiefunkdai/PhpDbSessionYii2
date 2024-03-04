<?php
/**
 * SDaiLover PHP Web Packages
 *
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.sdailover.com,
 *              https://www.stephanusdai.web.id
 * @license   : https://www.sdailover.com/license.html
 * @copyright : (c) ID 2023-2024 SDaiLover. All rights reserved.
 * This software using Yii Framework has released under the terms of the BSD License.
 */

namespace sdailover\models;
/**
 * Copyright (c) ID 2023-2024 SDaiLover (https://www.sdailover.com).
 * All rights reserved.
 *
 * Licensed under the Clause BSD License, Version 3.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.sdailover.com/license.html
 *
 * This software is provided by the SDAILOVER and
 * CONTRIBUTORS "AS IS" and Any Express or IMPLIED WARRANTIES, INCLUDING,
 * BUT NOT LIMITED TO, the implied warranties of merchantability and
 * fitness for a particular purpose are disclaimed in no event shall the
 * SDaiLover or Contributors be liable for any direct,
 * indirect, incidental, special, exemplary, or consequential damages
 * arising in anyway out of the use of this software, even if advised
 * of the possibility of such damage.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use SDaiLover;
use sdailover\yii\phpsessconnector\SDActiveProvider;

/**
 * SDaiLover User Search Provider
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDUserSearch extends SDUser
{
    public $createdfrom;
    public $createdto;
    
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['createdfrom', 'createdto'], 'datetime', 'format' => 'dd-MM-yyyy'],
            [['id', 'email', 'username', 'fullname', 'createdfrom', 'createdto'], 'safe'],
            [['status'], 'in', 'range' => [0, 1]],
        ];
    }
    
    public function scenarios()
    {
        return SDUser::scenarios();
    }
    
    public function search($params)
    {
        $query = SDUser::find();

        $dataProvider = new SDActiveProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'createdate' => SORT_DESC,
                    'username' => SORT_ASC, 
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->id !== null && !empty($this->id))
            $query->andFilterWhere(['id' => $this->id]);
        if ($this->username !== null && !empty($this->username))
            $query->andFilterWhere(['like', 'username', $this->username]);
            if ($this->email !== null && !empty($this->email))
                $query->andFilterWhere(['like', 'email', $this->email]);
        if ($this->fullname !== null && !empty($this->fullname))
            $query->andFilterWhere(['like', 'fullname', $this->fullname]);
        if (is_numeric($this->status) && $this->status > -1)
            $query->andFilterWhere(['status' => $this->status]);
        if (($this->createdfrom !== null && !empty($this->createdfrom))
            && ($this->createdto !== null && !empty($this->createdto))) {
            $query->andFilterWhere(['>=', 'createdate', $this->asDateModel($this->createdfrom)])
                  ->andFilterWhere(['<=', 'createdate', $this->asDateModel($this->createdto)]);
        }

        return $dataProvider;
    }
    
    protected function asDateModel($datetime)
    {
        if ($datetime !== null) {
            $part = explode('-', $datetime);
            $datetime = $part[2] . '-' . $part[1] . '-' . $part[0];
        }
        return $datetime;
    }
}