<?php
namespace app\models\Plans;

use yii\db\ActiveRecord;

class P0301_PRIEM_  extends ActiveRecord
{
  public function attributeLabels() {
      return [
        'NOD' => 'НОД',
        'DATE' => 'РАСЧЕТНАЯ ДАТА',
        'VS' => 'ПРИЕМ ВСЕГО',
        'GRU' => 'ПРИЕМ ГРУЖЕНЫХ ВСЕГО',
        'GRUKR' => 'ГРУЖЕНЫХ КРЫТЫХ',
        'GRUPL' => 'ГРУЖЕНЫХ ПЛАТФОРМ',
        'GRUPV' => 'ГРУЖЕНЫХ ПОЛУВАГОНОВ',
        'GRUZR' => 'ГРУЖЕНЫХ ЗЕРНОВОЗОВ',
        'GRURF' => 'ГРУЖЕНЫХ РЕФРЕЖЕРАТОРОВ',
        'GRUPR' => 'ГРУЖЕНЫХ ПРОЧИХ',
        'GRUCM' => 'ГРУЖЕНЫХ ЦЕМЕНТОВОЗОВ',
        'GRUCS' => 'ГРУЖЕНЫХ ЦИСТЕРН',
        'POR' => 'ПРИЕМ ПОРОЖНИХ ВСЕГО',
        'PORKR' => 'ПОРОЖНИХ КРЫТЫХ',
        'PORPL' => 'ПОРОЖНИХ ПЛАТФОРМ',
        'PORPV' => 'ПОРОЖНИХ ПОЛУВАГОНОВ',
        'PORZR' => 'ПОРОЖНИХ ЗЕРНОВОЗОВ',
        'PORRF' => 'ПОРОЖНИХ РЕФРЕЖЕРАТОРОВ',
        'PORPR' => 'ПОРОЖНИХ ПРОЧИХ',
        'PORCM' => 'ПОРОЖНИХ ЦЕМЕНТОВОЗОВ',
        'PORCS' => 'ПОРОЖНИХ ЦИСТЕРН',
      ];
  }
  /**
   * @return array the validation rules.
   */

   public function rules()
   {
     return [
       [['NOD','VS','GRU','GRUKR','GRUPL','GRUPV','GRUZR','GRURF','GRUPR','GRUCM','GRUCS','POR','PORKR','PORPL','PORPV','PORZR',
       'PORRF','PORPR','PORCM','PORCS'],'required', 'message' => 'Поле {attribute} обязательно для заполнения'],

       [['NOD','VS','GRU','GRUKR','GRUPL','GRUPV','GRUZR','GRURF','GRUPR','GRUCM','GRUCS','POR','PORKR','PORPL','PORPV','PORZR',
       'PORRF','PORPR','PORCM','PORCS'],'integer', 'message' => 'Поле {attribute} должно быть целочисленным'],

       ['NOD', 'string', 'max' => 2, 'min' => 1, 'tooLong' => 'Поле НОД должно иметь не более 2-х знаков'],

       [['NOD','VS','GRU','GRUKR','GRUPL','GRUPV','GRUZR','GRURF','GRUPR','GRUCM','GRUCS','POR','PORKR','PORPL','PORPV','PORZR',
       'PORRF','PORPR','PORCM','PORCS'],'number', 'min'=> 0, 'tooSmall' => 'Поле {attribute} не должно быть отрицательным'],
       [['VS'], 'validateV'],
       [['GRU'], 'validateGV'],
       [['POR'], 'validatePV'],
     ];
   }
   public function validateGV(){
     if ($this->GRU!=($this->GRUKR+$this->GRUPL+$this->GRUPV+$this->GRUZR+$this->GRURF+$this->GRUPR+$this->GRUCM+$this->GRUCS)){
       $this->addError('GRU','Поле ГРУЖЕНЫХ ВСЕГО не соответствует сумме полей');
     }
   }
   public function validatePV(){
     if ($this->POR!=($this->PORKR+$this->PORPL+$this->PORPV+$this->PORZR+$this->PORRF+$this->PORPR+$this->PORCM+$this->PORCS)){
       $this->addError('POR','Поле ПОРОЖНИХ ВСЕГО не соответствует сумме полей');
     }
   }
   public function validateV(){
     if ($this->VS!=($this->GRU+$this->POR)){
       $this->addError('VS','Поле ПРИЕМ ВСЕГО не соответствует сумме полей');
     }
   }
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return '{{P0301_PRIEM_}}';
    }
}
?>
