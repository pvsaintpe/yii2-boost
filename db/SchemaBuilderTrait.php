<?php

namespace pvsaintpe\boost\db;

/**
 * @mixin \yii\db\Migration
 */
trait SchemaBuilderTrait
{

    /**
     * @param int $default
     * @return \yii\db\ColumnSchemaBuilder
     */
    public function enabledShortcut($default = 0)
    {
        return $this->boolean()->notNull()->defaultValue($default);
    }

    /**
     * @return \yii\db\ColumnSchemaBuilder
     */
    public function createdAtShortcut()
    {
        return $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP');
    }

    /**
     * @return \yii\db\ColumnSchemaBuilder
     */
    public function updatedAtShortcut()
    {
        return $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    }

    /**
     * @param int $default
     * @return \yii\db\ColumnSchemaBuilder
     */
    public function deletedShortcut($default = 0)
    {
        return $this->boolean()->notNull()->defaultValue($default);
    }
}
