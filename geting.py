# -*- coding: utf-8 -*-
"""
Spyder Editor

This is a temporary script file.
"""


def gin(fin,fout):
    with open(fin,'r',encoding='utf8') as fname:
        ingredienti=set()
        i=0
        for riga in fname.readlines():
            ingrediente=''
            for carattere in riga:
                if carattere=='\n': break
                if carattere.isalpha() or carattere.isdigit(): ingrediente+=carattere
                else: ingrediente+=' '
            ennupla=(i,'f',ingrediente)
            ingredienti.add(ennupla)
            i+=1
        with open(fout,'w',encoding='utf8') as f:
            for enn in ingredienti:
                f.write('insert into Ingrediente(id,tipo,nome) values '+str(enn)+';'+'\n')
            f.close()
        fname.close()


gin('out.txt','ingredientisql.sql')
