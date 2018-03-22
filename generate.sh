#!/bin/sh

OUT="_schema.sql"

# create/clear file
echo '' > $OUT

# add schema and data
cat database/drop.sql >> $OUT
cat database/schema.sql >> $OUT
cat database/data.sql >> $OUT