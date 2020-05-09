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
        for riga in f.readlines():
            if riga[0]==':':
                ricette.append(ennupla)
                ennupla=[]
                i+=1
                ennupla.append(i)
                continue
            if riga[0]=='\n' or '====' in riga: continue
            else: ennupla.append(riga[:-1].replace("'",' '))
            
        f.close()
    with open (fout,'w',encoding='utf8') as f1:
        for enn in ricette[1:]:
            f1.write('insert into Ricetta(id,nome,tipo,descrizione) values '+str(tuple(enn))+';'+'\n')
            
        f1.close()
     
        
                
        
        
        
rep('ricOut.txt','ricOut2.sql')