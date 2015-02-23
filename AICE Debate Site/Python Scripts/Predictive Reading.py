# -*- coding: utf-8 -*-

import re

schoolname = {"Cypress Bay"}

names = {"Zonshen Yu","Hannah Kang","Eli Nir","Daniel Ruiz","Caleb Wong","Amun Majeed"}

readtext = ""

with open("out.txt","r") as myfile:
    readtext = myfile.read().replace('\n',' ')

print readtext

match = re.split("[RBH]ay",readtext)[1:]#"(?<=[0-9])\. \w+",readtext)

#print match[1]
print match

redNames = []

for line in match:
    temp = re.search("[\(\[].*?[\]\)]",line)#"[RBH]ay",line)
    #print line
    #print temp
    if temp is not None:
        name = re.search("[\(\[].*?[\]\)]",line)
        if name is not None:
            redNames.append(name.group(0)[1:len(name.group(0))-1])
    

prob = []
trueNames = []

charSum = 0.0
lowest = 9999.0
topName = ""
toptopProb=0.0

#print redNames

for redName in redNames:
    redName = redName.lower()
    for n in names:
        n = n.lower()
        nChar = 0
        for ch in redName:
            rnChar = 0
            found=False
            closest = 1
            for c in n:
                temp = 999
                if ch is c:
                    found=True
                    temp = abs(nChar - rnChar)
                if temp<closest:
                    closest = temp
                rnChar+=1
            if not found:
                charSum+=1.0
            else:
                charSum+=closest
            nChar+=1
        if (float(charSum)+abs(len(redName)-len(n)))/len(redName)<lowest:
            lowest = (float(charSum)+abs(len(redName)-len(n)))/len(redName)
            toptopProb = lowest
            topName = n
        charSum = 0
    lowest = 99999
    trueNames.append(topName.capitalize())
    print "LOWEST"
    print topName
    print redName
    print toptopProb
    print "-------"

print "top"
print trueNames
print redNames
