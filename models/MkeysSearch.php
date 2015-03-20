<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mkeys;

/**
 * MkeysSearch represents the model behind the search form about `frontend\models\Mkeys`.
 */
class MkeysSearch extends Mkeys
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'key', 'sid', 'flag', 'usetime', 'createtime', 'time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Mkeys::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sid' => $this->sid,
            'flag' => $this->flag,
            'usetime' => $this->usetime,
            'createtime' => $this->createtime,
            'time' => $this->time,
        ]);
        
        $query->andFilterWhere(['like', 'key', $this->key]);

        return $dataProvider;
    }
}
