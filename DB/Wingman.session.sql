/* SELECT COUNT(DISTINCT date), AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),SUM(kills),SUM(assists),SUM(deaths),SUM(mvp) FROM wingman WHERE playerName = 'Loviflo' */
/* SELECT map, COUNT(DISTINCT date) FROM wingman GROUP BY map ORDER BY COUNT(DISTINCT date) DESC */
/* SELECT DATE_FORMAT(date,'%d/%m/%Y'), COUNT(DISTINCT date) FROM wingman GROUP BY date(date) ORDER BY COUNT(DISTINCT date) DESC LIMIT 5 -- Affichage des jours avec le plus de parties */
/* SELECT DISTINCT map, DATE_FORMAT(date,'%d/%m/%Y %H:%i'), waitTime, matchDuration, matchScore FROM wingman ORDER BY id LIMIT 0, 100 */
/* SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE WEEK (date) = WEEK((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND YEAR(date) = YEAR((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND playerName = 'Loviflo' -- Affichage de la semaine dernière */
/* SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE WEEK (date) = WEEK((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) - 1 AND YEAR(date) = YEAR((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND playerName = 'Loviflo' -- Affichage d'il y a deux semaines */
/* SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE WEEK (date) = WEEK((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND YEAR(date) = YEAR((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND playerName = 'Ilesis' -- Affichage de la semaine dernière */
/* SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE WEEK (date) = WEEK((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) - 1 AND YEAR(date) = YEAR((SELECT date(date) FROM wingman WHERE id = (SELECT MAX(id) FROM wingman))) AND playerName = 'Ilesis' -- Affichage d'il y a deux semaines */

/* 
create or replace view displayGames as
select maxid,map,matchDate, waitTime, matchDuration, matchScore,'Victoire' as result from 
(SELECT  max(id) as maxid, map, date matchDate, waitTime, matchDuration, matchScore 
FROM wingman w group by map, date, waitTime, matchDuration, matchScore)  as wingf
where ((select playername from wingman where id=wingf.maxid) in ('Loviflo','Ilesis') and matchScore like '9%') Or 
((select playername from wingman where id=wingf.maxid) not in ('Loviflo','Ilesis') and matchScore like '%9')
union 
select maxid,map,matchDate, waitTime, matchDuration, matchScore,'Défaite' as result from 
(SELECT  max(id) as maxid, map, date matchDate, waitTime, matchDuration, matchScore 
FROM wingman w group by map, date, waitTime, matchDuration, matchScore)  as wingf
where ((select playername from wingman where id=wingf.maxid) in ('Loviflo','Ilesis') and matchScore like '%9') Or 
((select playername from wingman where id=wingf.maxid) not in ('Loviflo','Ilesis') and matchScore like '9%')
union 
select maxid,map,matchDate, waitTime, matchDuration, matchScore,'Egalité' as result from 
(SELECT  max(id) as maxid, map, date matchDate, waitTime, matchDuration, matchScore 
FROM wingman w group by map, date, waitTime, matchDuration, matchScore)  as wingf 
 where matchScore like '%8%' ; */


  -- select DATE_FORMAT(matchDate,'%d/%m/%Y') as date,count(*)  from displaygames where result='Egalité' group by date order by matchDate desc
  /* select DATE_FORMAT(matchDate,'%d/%m/%Y') as date,count(*)  from displaygames where result='Egalité' group by date having count(*)>4 order by matchDate desc */
  /* select DATE_FORMAT(matchDate,'%d/%m/%Y') as date,count(*)  from displaygames where result='Egalité' group by date order by count(*) desc */
  /* select DATE_FORMAT(matchDate,'%d/%m/%Y') as date,(SELECT count(*) FROM displaygames WHERE result = 'Défaite' AND DATE_FORMAT(dg.matchDate,'%d/%m/%Y') = DATE_FORMAT(matchDate,'%d/%m/%Y') having count(*)>0)  from displaygames as dg GROUP BY date */

/* 
(SELECT  max(id) as maxid, map, DATE_FORMAT(date,'%d/%m/%Y %H:%i') matchDate, waitTime, matchDuration, matchScore 
FROM wingman w group by map, DATE_FORMAT(date,'%d/%m/%Y %H:%i'), waitTime, matchDuration, matchScore)  as wingf


select * from wingf
where ((select playername from wingman where id=wingf.maxid) in ('Loviflo','Ilesis') and matchScore like '9%') Or 
((select playername from wingman where id=wingf.maxid) not in ('Loviflo','Ilesis') and matchScore like '%9')
 */
