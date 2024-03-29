###ORGANISATION DU FICHIER CSV : 
#Player name ; Ping ; Kill ; Assist ; Death ; MVP ; Accuracy ; Score ; Map ; Date ; Wait time ; Match duration

###Création d'une variable str ne prenant que le numérique d'une entrée str
def create_num(word) :
    num = ''
    for e in word : 
        try : 
            num = num + str(int(e))
        except : 
            if e == ':' :
                num = num + str(":")
    return(num)



###Fonction d'écriture dans un fichier csv
def write_csv(liste1, liste2, mode, writing = False) : 
    #Ecriture 
    E = open("vi_info.csv", mode, encoding='utf-8')
    for player in liste1 :
        for e in player : 
            if 'Ilesis' in e :
                writing = True 
    if writing == True :
        for players in liste1 : 
            #print(players)
            message = ''
            for e in players :
                if e != '' :
                    if ';' in e : 
                        l = e.split(';')
                        e = ''
                        for e_l in l : 
                            e = e + ' ' + e_l 
                    message = message + e + ' ; '
                else : 
                    message = message + '0' + ' ; '
            
            for e in liste2 : 
                if ';' in e : 
                    l = e.split(';')
                    e = ''
                    for e_l in l : 
                        e = e + ' ' + e_l 
                message = message + e + ' ; '
            print(message)
            compteur_vir = 0
            list_message = message.split(";")
            print(list_message)

            message_vf = '' 
            for i in range(0,12) : 
                message_vf = message_vf + list_message[i] + ' ; '
            message_vf = message_vf + list_message[12]
            E.write(message_vf)
            E.write('\n')
    E.close




###Initialisation et variables
compteur = 0 
c=0
i_info_match = 0
content_info_g = 0
score = '0 : 0'
next_line = False
info_match = []
info_tempo = []
info_match_players = []

###Initialisation du fichier écriture
E = open("DB/vi_info2.csv", 'w', encoding='utf-8') 
E.close()


###Programme principal
F = open("DB/message2.txt", encoding="utf-8") 
for l in F.readlines() :
    if content_info_g == 0 :
    #Lecture des informations générales de la partie 
        if 'Wingman' in l : 
            if len(info_match) == 5 :
                write_csv(info_match_players, info_match, 'a')
                info_match_players = []
                info_match = []
            L = l.split(' ')
            message = ''
            for i in range(0,2) : 
                message = message + ' ' + L[i].strip("<span><span><div'").strip('\t\t\t\t\t\t').strip('\t\t\t\t\t</td>\n')
            if 'hortdu' in message : 
                info_match.append('Shortdust')
            elif 'obble' in message : 
                info_match.append('Cobblestone')
            elif 'rain' in message : 
                info_match.append('Train') 
            elif 'verpass' in message : 
                info_match.append('Overpass') 
            elif 'ferno' in message : 
                info_match.append('Inferno')     
            elif 'ake' in message : 
                info_match.append('Lake')
            elif 'ialto' in message : 
                info_match.append('Rialto') 
            elif 'ertigo' in message : 
                info_match.append('Vertigo') 
            elif 'nuke' in message : 
                info_match.append('Nuke') 
            elif 'lysion' in message : 
                info_match.append('Elysion') 
            elif 'guar' in message : 
                info_match.append('Guard') 
            else :
                info_match.append(message)
             

        if 'GMT' in l : 
            L = l.split(' ')
            message = ''
            for i in range(0,2): 
                message = message + ' ' + L[i].strip('\t\t\t\t\t\t')
            info_match.append(message)

            

        if 'Wait Time' in l : 
            L = l.split(' ')
            message1 = ''          
            message = ''
            for i in range (0,2) : 
                message1 = message1 + ' ' +  L[i].strip("</td>\n'").strip('\n').strip('\t\t\t\t\t')
            message2 = create_num(L[2])
            message = message1 + ' ' + message2
            info_match.append(message.strip('Wai Time:'))


        if 'Match Duration' in l : 
            L = l.split(' ')
            message1 = ''
            message = ''
            for i in range (0,2) : 
                message1 = message1 + ' ' +  L[i].strip("</td>\n'").strip('\n').strip('\t\t\t\t\t')
            message2 = create_num(L[2])
            message = message1 + ' ' + message2
            info_match.append(message.strip('Match Duration:'))


    #Lecture des informations générales des joueurs 
    if compteur != 0 : 
        if compteur != 8 :
            info_tempo.append(create_num(l))
        compteur = compteur -1

    else : 
        if info_tempo != []:
            info_match_players.append(info_tempo)
            content_info_g = content_info_g - 1
        info_tempo = []


    if 'class="playerNickname ellipsis"' in l :
        if content_info_g == 0:  
            content_info_g = 4
        compteur = 8
        pseudo = l.split(">")[2].strip('</a').strip(';')
        info_tempo = [str(pseudo).strip("\n").strip('</a').strip(';')]

    #Lecture du score
    if 'class="csgo_scoreboard_score"' in l : 
        score = l.strip('\t\t\t\t\t\t<tr><td colspan="8" class="csgo_scoreboard_score">').strip('/td></tr>\n')
        if ': 8' in score : 
            score = '8 : 8' 
        if ': 2' in score :
            score = '9 : 2'
        info_match.append(score)

    #print(info_match_players, info_match)


F.close
