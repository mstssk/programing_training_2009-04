#!/bin/sh

echo "プログラム${0%.sh}の処理を開始します"

#元データ
inputtab=./yoteinouhin.csv
makerstab=./hacchuusaki.tsv

#出力先
output=./yoteiNouhin_withMakerName.csv

#発注先テーブル読み込み
echo ""
echo "発注先名称テーブル"
declare -i i=0
while read line
do
  #スペース区切りのデータの初の列だけ読み込み
  maker=`echo $line | cut -d ' ' -f1 `
  #発注先コードと社名を切り分けて、
  #それぞれスペース区切りで１つの文字列にしておく
  #(あとでevalを使い、一気に配列変数にする)
  codes=$codes" "`echo $maker|cut -c1-8`
  names=$names" "`echo $maker|cut -c9-`

  i=$i+1
done < $makerstab

#スペース区切りの文字列を一気に配列に変換
eval maker_code=($codes)
eval maker_name=($names)

#テーブル上の会社の数
declare -i maker_num=$i
echo "全 $maker_num社"

#予定納品データテーブルを読み込みながら
#社名を追加したものを書き出し
echo ""
echo "予定納品データテーブルに社名追加"
while read line
do
  #カンマ区切りをスペースに変換、一気に配列に
  data=`echo $line|sed 's/,/\ /g'`
  eval array=($data)
  
  i=0
  while [ $i -lt $maker_num ]
  do
    maker_code=${maker_code[i]}
    if [ ${array[2]} = $maker_code ]
    then
      #一致する仕入れ先コードを見つけた場合、社名を加えて書き出し
      echo ${array[0]}","${array[1]}","${array[2]}","${maker_name[i]}","${array[3]} >> $output
      continue 2
    fi
    i=$i+1
  done
  #仕入れ先コードが何れとも一致しなかった場合、元のデータをそのまま書き出し
  echo $line >> $output 
 
done < $inputtab

echo "プログラム${0%.sh}の処理を開始します"
exit

