#!/bin/bash
cd /home/mma
rm -f /home/mma/bierstedif.zip
zip -r /home/mma/bierstedif.zip bierstedif -x "bierstedif/.claude/*"
echo "Compressed to /home/mma/bierstedif.zip"
