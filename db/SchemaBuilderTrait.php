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
        return $this->timestamp()->notNull()->defaultExpression('current_timestamp()');
    }

    /**
     * @return \yii\db\ColumnSchemaBuilder
     */
    public function updatedAtShortcut()
    {
        return $this->timestamp()->notNull()->defaultExpression('current_timestamp() ON UPDATE current_timestamp()');
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
