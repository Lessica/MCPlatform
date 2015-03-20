<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mscripts;

/**
 * MscriptsSearch represents the model behind the search form about `frontend\models\Mscripts`.
 */
class MscriptsSearch extends Mscripts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'size', 'createtime', 'runtimes'], 'integer'],
            [['name', 'version', 'md5', 'sha1', 'sha256', 'update_logs'], 'safe'],
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
        $query = Mscripts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'size' => $this->size,
            'createtime' => $this->createtime,
            'runtimes' => $this->runtimes,
        ]);

        $query->andFilterWhere(['like', 'md5', $this->md5])
            ->andFilterWhere(['like', 'sha1', $this->sha1])
            ->andFilterWhere(['like', 'sha256', $this->sha256])
            ->andFilterWhere(['like', 'version', $this->sha256])
            ->andFilterWhere(['like', 'update_logs', $this->sha256])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
