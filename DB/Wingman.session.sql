-- SELECT COUNT(DISTINCT date), AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),SUM(kills),SUM(assists),SUM(deaths),SUM(mvp) FROM wingman WHERE playerName = 'Loviflo'
/* SELECT map, COUNT(DISTINCT date) FROM wingman GROUP BY map ORDER BY COUNT(DISTINCT date) DESC */
/* SELECT DATE_FORMAT(date,'%d/%m/%Y'), COUNT(DISTINCT date) FROM wingman GROUP BY date(date) ORDER BY COUNT(DISTINCT date) DESC LIMIT 5 -- Affichage des jours avec le plus de parties */
/* SELECT DISTINCT map, DATE_FORMAT(date,'%d/%m/%Y %H:%i'), waitTime, matchDuration, matchScore FROM wingman ORDER BY id LIMIT 0, 100 */
/* SELECT * FROM wingman WHERE date >= current_date - 14 AND date <= current_date - 7 ORDER BY id -- Affichage d'il y a 2 semaines */
/* SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp) FROM wingman WHERE date >= (SELECT date(date) FROM wingman WHERE id='1') - 7 AND playerName = 'Loviflo' ORDER BY id -- Affichage de la semaine dernière  */
/* SELECT AVG(kills),AVG(assists),AVG(deaths),AVG(mvp),AVG(hsp),AVG(adr),AVG(ud),AVG(ef),AVG(playerScore) FROM wingman WHERE date >= (SELECT date(date) FROM wingman WHERE id='1') - 14 AND date >= (SELECT date(date) FROM wingman WHERE id='1') - 7 AND playerName = 'Loviflo' -- Affichage d'il y a 2 semaines  */
