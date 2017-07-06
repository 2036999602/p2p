<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%loans}}".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $loaner_property
 * @property string $auditer_id
 * @property string $cooperation_code
 * @property string $loan_amount
 * @property string $mini_investment_amount
 * @property string $year_yield_rate
 * @property integer $loan_bid_type
 * @property integer $term_of_loan
 * @property string $loan_type
 * @property integer $repayment_type
 * @property integer $investment_award_type
 * @property string $investment_award_amount
 * @property string $need_password
 * @property string $qualification_information
 * @property string $load_content
 * @property string $usage_of_loan
 * @property string $repayment_source
 * @property string $repayment_guarantee
 * @property integer $status
 * @property string $remark
 * @property string $created_at
 * @property string $update_at
 */
class LoansModel extends \yii\db\ActiveRecord
{
    public $search_keyword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%loans}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cooperation_id','loaner_property','auditer_id', 'loan_bid_type', 'term_of_loan', 'loan_type', 'repayment_type', 'investment_award_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['loan_amount', 'mini_investment_amount', 'year_yield_rate', 'investment_award_amount'], 'number'],
            [['load_content', 'repayment_source', 'repayment_guarantee'], 'required','on'=>['add','update']],
            [['load_content', 'repayment_source', 'repayment_guarantee'], 'string'],
            [['cooperation_code'], 'string', 'max' => 20],
            [['need_password', 'remark','usage_of_loan'], 'string', 'max' => 255],
            [['qualification_information'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '发标人ID',
            'loaner_property' => '借款人属性',
            'auditer_id' => '审核人ID',
            'cooperation_id' =>'企业编号',
            'cooperation_code' => '企业自定标的编码',
            'loan_amount' => '借款金额',
            'mini_investment_amount' => '最小投资额',
            'year_yield_rate' => '年化益率',
            'loan_bid_type' => '0-月标 1-天标',
            'term_of_loan' => '借款期限',
            'loan_type' => '借款类型financial_type_id',
            'repayment_type' => '还款方式payment_typ_id',
            'investment_award_type' => '投资奖励类型 0-不奖励 1-红包 2-加息',
            'investment_award_amount' => '奖励数量',
            'need_password' => '定向标（密码标）',
            'qualification_information' => '资质信息ID组',
            'load_content' => '标的内容',
            'usage_of_loan' => '借款用途',
            'repayment_source' => '还款来源',
            'repayment_guarantee' => '还款保障',
            'status' => '0-待审核 1-已审核 2-准备标 3-审核拒绝 4-风控不合格 5-标满 6-流标 7-转让 ',
            'remark' => '备注',
            'created_at' => '创建时间',
            'updated_at' => '编辑时间',
        ];
    }
}
