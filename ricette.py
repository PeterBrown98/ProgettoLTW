# -*- coding: utf-8 -*-
"""
Spyder Editor

This is a temporary script file.
"""

def rep(fname,fout):
    with open (fname,'r',encoding='utf8') as f:
        i=-1
        ricette=[]
        ennupla=[]
        ingredienti=''
        for riga in f.readlines():
            if riga[0]==':':
                if ingredienti!='':
                    ennupla.append(ingredienti)
                if ennupla!=[] and (ennupla[2]!='Bevande' and ennupla[2]!='Antipasti'): ricette.append(ennupla)
                ennupla=[]
                i+=1
                ennupla.append(i)
                ingredienti=''
                continue
            if '====' in riga: 
                ingredienti+=riga.replace('====', 'Di').replace("'",' ')[:-1]+'\t'
                
            if riga[0]=='\n': continue
            elif not '====' in riga: ennupla.append(riga[:-1].replace("'",' '))
            
        f.close()
        for enn in ricette:
            if enn!=[] and (enn[2]=='Pollame' or enn[2]=='Carne' or enn[2]=='Pesce'): enn[2]='Secondo' 
    with open (fout,'w',encoding='utf8') as f1:
        for enn in ricette[1:]:
            f1.write('insert into Ricetta(id,nome,tipo,descrizione,ingredienti) values '+str(tuple(enn))+';'+'\n')
            
        f1.close()
     
        
                
        
        
        
rep('/home/pc/Scrivania/dbrice13/ricOut.txt','/home/pc/Scrivania/dbrice13/pannocchia.sql')