--災害対策ステップの各項目のinsert文


insert into step(cid, sno, snote)
values('0001','1','防災バッグを準備する');

insert into step(cid, sno, snote)
values('0001','2','避難所を確認する');



insert into step(cid, sno, snote)
values ('0001','3','緊急連絡先を登録する');

insert into step (cid, sno, snote)
values ('0001','4','非常食を備蓄する');





--step1のinsert文

insert into STEP_DETAIL
values('0001', '1', '1', '水(3日分~1週間分を目安)');


insert into STEP_DETAIL
values('0001', '1', '2', '非常食(3日分~1週間分を目安)');


insert into STEP_DETAIL
values('0001', '1', '3', '懐中電灯(LEDが好ましい)');

insert into STEP_DETAIL
values('0001', '1', '4', '乾電池(単3形または単4系が好ましい)');

insert into STEP_DETAIL
values('0001', '1', '5', 'モバイルバッテリー(容量は10,000Ah~20,000Ahを目安)');


insert into STEP_DETAIL
values('0001', '1', '6', '現金(小銭含む)');


insert into STEP_DETAIL
values('0001', '1', '7', '常備薬(痛み止めやアレルギー等)');

insert into STEP_DETAIL
values('0001', '1', '8', 'ラジオ(手回し充電,太陽光発電できるものが好ましい)');


--step2のinsert文

insert into step_detail(cid, sno, dno, detail)

values('0001','2','1','自治体などが出している避難所などの情報を確認する');
 
insert into step_detail(cid, sno, dno, detail)

values('0001','2','2','複数の避難経路を考えておく');
 
insert into step_detail(cid, sno, dno, detail)

values('0001','2','3','情報を元に実際に行ってみる');

--step3のinsert文

insert into step_detail(cid, sno, dno, detail)
values('0001','3','1','緊急連絡先にする人を決める（親、兄弟姉妹、親しい親族、信頼できる友人など　※できれば複数人登録しておくと安心）');
 
insert into step_detail(cid, sno, dno, detail)
values('0001','3','2','情報の間違いがないか確認、まとめる（氏名、続柄、電話番号、メールアドレス、住所など）');
 
insert into step_detail(cid, sno, dno, detail)
values('0001','3','3','本人に了承を得る');
 
insert into step_detail(cid, sno, dno, detail)
values('0001','3','4','スマートフォンに登録する');


--step4のinsert文

insert into STEP_DETAIL
values('0001', '4', '1', '水(2Lのペットボトル6本を2箱分)');


insert into STEP_DETAIL
values('0001', '4', '2', 'お米(2kgを一袋,パックご飯を3個)');

insert into STEP_DETAIL
values('0001', '4', '3', '缶詰(肉,野菜,魚の缶詰を9個)');
