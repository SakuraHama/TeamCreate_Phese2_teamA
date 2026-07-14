




--STEP1 家具を買う前にする準備


insert into step(cid, sno, snote)
values('0003','1','家具を購入する前にする準備');


insert into STEP_DETAIL
values('0003', '1', '1', '家具を収めるスペースを測る (壁・床・窓・ドア・コンセントなども含めた位置や高さまで正確に測る)');

insert into STEP_DETAIL
values('0003', '1', '2', 'どの家具を優先して生活に取り入れたいか(最初は自分の生活に今必要な家具を優先する)');

insert into STEP_DETAIL
values('0003', '1', '3', '価格帯を調べる(自分の予算と比べてみる)');




--step2  

insert into step(cid, sno, snote)
values('0003','2','家電を購入する前にする準備');




insert into STEP_DETAIL
values('0003', '2', '1', '備え付きの家電が自分の住居にあるかどうかを確認する(備え付きの家電は機能が少ない場合があるので、機能も確認しておく)');


insert into STEP_DETAIL
values('0003', '2', '2', '部屋の間取りやスペースを確認する(搬入時のことも考えて、玄関のドアの幅や広さも確認しておく)');



insert into STEP_DETAIL
values('0003', '2', '3', '生活に必須なものから選ぶ(例えば,冷蔵庫・洗濯機・電子レンジ等)');






--STEP3

insert into step(cid, sno, snote)
values('0003','3','家具,家電を購入する際にやる事');

insert into STEP_DETAIL
values('0003', '3', '1', '購入店舗を決める (ここなら信用できるというお店やオンラインショップを決める)');



insert into STEP_DETAIL
values('0003', '3', '2', '購入形式を決める。(セットで買うか、単品で買うかなどを決める)');

insert into STEP_DETAIL
values('0003', '3', '3', '家電、家具の安全性と機能の確認(また、保証やサービスなども心配なら確認しておく)');

insert into STEP_DETAIL
values('0003', '3', '4', '家電、家具の搬入時期を購入前に確認しておく(時期によって時期が変動する場合があるので,確認しておく)');



--STEP4

insert into step(cid, sno, snote)
values('0003','4','家具,家電を購入した後にやる事');



insert into STEP_DETAIL
values('0003', '4', '1', '災害などを想定し、家具や家電の保険を確認しておく(各保険会社で確認)');

insert into STEP_DETAIL
values('0003', '4', '2', '実際に使用してみて、不備がないかを探す(できるだけすぐに確認しておく)');


























