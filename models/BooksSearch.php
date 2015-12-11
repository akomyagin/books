<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;
/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books
{
    public $authorfullname;

    public $date_from;
    
    public $date_to;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name', 'date_from','date_to', 'authorfullname'], 'safe'],
          /*  [['date_from','date_to'], 'date', 'format' => 'php:Y-m-d', 'skipOnEmpty' => true],
            [['date_from','date_to'], 'filter', 'filter' => function($value){
                $date = \DateTime::createFromFormat('Y-m-d', $value );
                return $date ? date( 'Y-m-d', $date->getTimestamp() ) : null;
            }],*/
        ];
    }
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'date_from' => Yii::T('app', 'Date From'),
            'date_to' => Yii::T('app', 'Date To'),
        ]);
    }
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        Yii::$app->session['BooksSearch'] = $params;
        $query = Books::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'preview',
                'authorfullname' => [
                    'asc' => ['authors.firstname' => SORT_ASC, 'authors.lasttname' => SORT_ASC],
                    'desc' => ['authors.firstname' => SORT_DESC, 'authors.lasttname' => SORT_DESC],
                    'label' => Yii::t('app', 'Author'),
                    'default' => SORT_ASC
                ],
                'date',
                'date_create'
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['author']);
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'name', $this->name]);
        if ($this->date_from) {
            $query->andFilterWhere(['>=', 'date', $this->date_from]);
        }
        if ($this->date_to) {
            $query->andFilterWhere(['<=', 'date', $this->date_to]);
        }
        if ($this->author_id) {
            $query->andFilterWhere(['author_id' => $this->author_id]);
        }
        $query->joinWith(['author']);
        return $dataProvider;
    }
}