<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mdevices;

/**
 * MdevicesSearch represents the model behind the search form about `frontend\models\Mdevices`.
 */
class MdevicesSearch extends Mdevices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid', 'regtime', 'totime', 'role', 'runtimes'], 'integer'],
            [['uuid'], 'safe'],
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
        $query = Mdevices::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sid' => $this->sid,
            'regtime' => $this->regtime,
            'totime' => $this->totime,
            'role' => $this->role,
            'runtimes' => $this->runtimes,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid]);

        return $dataProvider;
    }
}
