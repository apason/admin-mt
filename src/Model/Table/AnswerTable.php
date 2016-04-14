<?php
namespace App\Model\Table;

use App\Model\Entity\Answer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Answer Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Task
 * @property \Cake\ORM\Association\BelongsTo $Subuser
 * @property \Cake\ORM\Association\HasMany $Likes
 */
class AnswerTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('answer');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Task', [
            'foreignKey' => 'task_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subuser', [
            'foreignKey' => 'subuser_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Likes', [
            'foreignKey' => 'answer_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->boolean('uploaded')
            ->requirePresence('uploaded', 'create')
            ->notEmpty('uploaded');

        $validator
            ->boolean('enabled')
            ->requirePresence('enabled', 'create')
            ->notEmpty('enabled');

        $validator
            ->allowEmpty('uri');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['task_id'], 'Task'));
        $rules->add($rules->existsIn(['subuser_id'], 'Subuser'));
        return $rules;
    }
}
