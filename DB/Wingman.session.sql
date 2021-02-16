-- SELECT * FROM wingman WHERE Score LIKE '9-7' ORDER BY ID DESC LIMIT 0,100
/* SELECT Score,COUNT(*) FROM wingman GROUP BY Score */
-- SELECT SUM(kills) FROM wingman WHERE playerName = 'Loviflo'
-- SELECT COUNT(DISTINCT date), AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),SUM(kills),SUM(assists),SUM(deaths),SUM(mvp) FROM wingman WHERE playerName = 'Loviflo'
/* SELECT map, COUNT(DISTINCT date) FROM wingman GROUP BY map ORDER BY COUNT(DISTINCT date) DESC */
-- SELECT COUNT( DISTINCT date) FROM wingman
-- SELECT DATE_FORMAT(date,"%d/%m/%Y") FROM wingman
/* SELECT * FROM wingman WHERE date(date) = '2020-07-28' */
SELECT COUNT(DISTINCT date) FROM wingman GROUP BY date(date) ORDER BY COUNT(DISTINCT date) DESC