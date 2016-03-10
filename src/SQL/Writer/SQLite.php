<?php
/*
   The MIT License (MIT)

   Copyright (c) 2015 César Rodas

   Permission is hereby granted, free of charge, to any person obtaining a copy
   of this software and associated documentation files (the "Software"), to deal
   in the Software without restriction, including without limitation the rights
   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
   copies of the Software, and to permit persons to whom the Software is
   furnished to do so, subject to the following conditions:

   The above copyright notice and this permission notice shall be included in
   all copies or substantial portions of the Software.

   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
   IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
   AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
   LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
   OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
   THE SOFTWARE.
*/
namespace SQL\Writer;

use SQL\Writer;
use SQLParser\Stmt;

class SQLite extends Writer
{
    public function columnDefinition(Stmt\Column $column)
    {
        $sql = $this->escape($column->GetName()) 
            . " "
            . $this->dataType($column->getType(), $column->getTypeSize())
            . $column->getModifier();


        if ($column->isNotNull()) {
            $sql .= " NOT NULL";
        }

        if ($column->defaultValue()) {
            $sql .= " DEFAULT " . $this->value($column->defaultValue());
        }

        if ($column->isPrimaryKey()) {
            $sql .= " PRIMARY KEY";
        }

        if ($column->isAutoIncrement()) {
            $sql .= " AUTO_INCREMENT";
        }


        return $sql;
    }
}