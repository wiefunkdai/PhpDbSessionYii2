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

namespace sdailover\components;
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
use yii\base\InvalidConfigException;

/**
 * SDaiLover Password Validator Component
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDPasswordValidator extends \yii\validators\Validator
{
    public $min = 8;
    public $max;    
    public $mixedCase = true;
    public $letters = true;
    public $numbers = true;
    public $symbols = true;
    public $skipOnEmpty = false;
    public $copyAttributeTo;
    public $message;
    
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = [
                'min' => SDaiLover::t('yii', '{attribute} "{value}" minimum sentence length {size}.'),
                'max' => SDaiLover::t('yii', '{attribute} "{value}" maximum sentence length {size}.'),
                'mixedCase' => SDaiLover::t('yii', '{attribute} "{value}" must be a combination of uppercase and lowercase (a-z, A-Z).'),
                'letters' => SDaiLover::t('yii', '{attribute} "{value}" must have a combination of letters (a-z).'),
                'symbols' => SDaiLover::t('yii', '{attribute} "{value}" must have a combination of symbols (a-z).'),
                'numbers' => SDaiLover::t('yii', '{attribute} "{value}" must have a combination of numbers (0-9).')
            ];
        } else {
            if (is_array($this->message) && count($this->message) > 1) {
                return;
            }
            throw new InvalidConfigException('Invalid configuration message must be array.');
        }
    }

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        if (!is_string($value)) {
            return;
        }

        if ($model->getIsNewRecord()) {
            if ($value == null && empty($value) && trim($value) == '') {
                $this->addError($model, $attribute, 'Password cannot be blank.');
            }
        }
        if ($value !== null && !empty($value) && trim($value) !== '') {
            if ($this->min && mb_strlen($value) < $this->min) {
                $this->addError($model, $attribute, $this->message['min'], ['size' => $this->min]);
            }

            if ($this->max && mb_strlen($value) > $this->max) {
                $this->addError($model, $attribute, $this->message['max'], ['size' => $this->max]);
            }

            if ($this->mixedCase && ! preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/u', $value)) {
                $this->addError($model, $attribute, $this->message['mixedCase']);
            }

            if ($this->letters && ! preg_match('/\pL/u', $value)) {
                $this->addError($model, $attribute, $this->message['letters']);
            }

            if ($this->symbols && ! preg_match('/\p{Z}|\p{S}|\p{P}/u', $value)) {
                $this->addError($model, $attribute, $this->message['symbols']);
            }

            if ($this->numbers && ! preg_match('/\pN/u', $value)) {
                $this->addError($model, $attribute, $this->message['numbers']);
            }

            if (!$model->hasErrors() && $this->copyAttributeTo) {
                $attr = $this->copyAttributeTo;
                $model->$attr = $value;
                $model->$attribute = null;
            }
        }
    }
}