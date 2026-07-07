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
