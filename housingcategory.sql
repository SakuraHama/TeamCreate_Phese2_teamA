-- 住居準備カテゴリのSTEP、項目まとめ

-- STEP１部屋探しの挿入
insert into step(cid, sno, snote)
values('0002','1','部屋探し');

-- 項目１どのような部屋に住みたいかを考える
insert into step_detail(cid, sno, dno, detail)
values('0002','1','1','どのような部屋に住みたいかを考える');

-- 項目２許容範囲の家賃を考える
insert into step_detail(cid, sno, dno, detail)
values('0002','1','2','許容範囲の家賃を考える');

-- 項目３部屋の広さはどれぐらいが良いか考える
insert into step_detail(cid, sno, dno, detail)
values('0002','1','3','部屋の広さはどれぐらいが良いか考える');

-- 項目４駅からの距離はどれぐらいがいいか考える
insert into step_detail(cid, sno, dno, detail)
values('0002','1','4','駅からの距離はどれぐらいがいいか考える');

-- 項目５学校や職場への通いやすさを考える
insert into step_detail(cid, sno, dno, detail)
values('0002','1','5','学校や職場への通いやすさを考える');

-- 項目６近くにコンビニやスーパーが欲しいか考える
insert into step_detail(cid, sno, dno, detail)
values('0002','1','6','近くにコンビニやスーパーが欲しいか考える');

-- 項目７帰り道の明るさなども考える
insert into step_detail(cid, sno, dno, detail)
values('0002','1','7','帰り道の明るさなども考える');

-- 項目８妥協案を複数考える（案を複数考える事によって、部屋が探しやすくなる）
insert into step_detail(cid, sno, dno, detail)
values('0002','1','8','妥協案を複数考える（案を複数考える事によって、部屋が探しやすくなる）');


-- STEP２物件の内見の挿入
insert into step(cid, sno, snote)
values('0002','2','物件の内見');

-- 項目１気になる部屋が見つかったら、不動産会社に連絡し内見する
insert into step_detail(cid, sno, dno, detail)
values('0002','2','1','気になる部屋が見つかったら、不動産会社に連絡し内見する');

-- 項目２スマホの電波が入るか確認する
insert into step_detail(cid, sno, dno, detail)
values('0002','2','2','スマホの電波が入るか確認する');

-- 項目３日当たりのよさや風当たりの良さを確認する
insert into step_detail(cid, sno, dno, detail)
values('0002','2','3','日当たりのよさや風当たりの良さを確認する');

-- 項目４家具の配置を想像してコンセントの配置を確認する
insert into step_detail(cid, sno, dno, detail)
values('0002','2','4','家具の配置を想像してコンセントの配置を確認する');

-- 項目５収納スペースを開けて確認する
insert into step_detail(cid, sno, dno, detail)
values('0002','2','5','収納スペースを開けて確認する');

-- 項目６廊下や郵便受け、ゴミ捨て場などの共用スペースを確認する
insert into step_detail(cid, sno, dno, detail)
values('0002','2','6','廊下や郵便受け、ゴミ捨て場などの共用スペースを確認する');

-- 項目７最寄りの駅から部屋まで歩いて、かかる時間や道の安全性を確認する
insert into step_detail(cid, sno, dno, detail)
values('0002','2','7','最寄りの駅から部屋まで歩いて、かかる時間や道の安全性を確認する');


-- STEP３住居の契約の挿入
insert into step(cid, sno, snote)
values('0002','3','住所の契約');

-- 項目１契約者の身分証明書を用意する（運転免許証、健康保険証など）　※ただし物件によって必要な書類が異なる
insert into step_detail(cid, sno, dno, detail)
values('0002','3','3','収入証明書や内定通知書を用意する（物件によっては必要ない場合もある）');

-- 項目２住民票を用意する（契約時に必要）
insert into step_detail(cid, sno, dno, detail)
values('0002','3','2','住民票を用意する（契約時に必要）');

-- 項目３収入証明書や内定通知書を用意する（物件によっては必要ない場合もある）
insert into step_detail(cid, sno, dno, detail)
values('0002','3','3','収入証明書や内定通知書を用意する（物件によっては必要ない場合もある）');

-- 項目４連帯保証人がいる場合は、連帯保証人の収入証明書、承諾書などを用意する　※連帯保証人となる親が遠方に住んでいる場合は、１週間ほど余裕を見ておくと安心
insert into step_detail(cid, sno, dno, detail)
values('0002','3','4','連帯保証人がいる場合は、連帯保証人の収入証明書、承諾書などを用意する　※連帯保証人となる親が遠方に住んでいる場合は、１週間ほど余裕を見ておくと安心');
