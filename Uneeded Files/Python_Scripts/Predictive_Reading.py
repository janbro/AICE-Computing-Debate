#!/usr/bin/env python
# -*- coding: utf-8 -*-

import re

class student:
    def __init__(self, readName, predictedName, wins = 0):
        self.readName = readName
        self.predictedName = predictedName
        self.line = line
        self.wins = wins
    
schoolname = {"Cypress Bay"}

names = {}
with open("../../temp/names.txt","r") as myfile:
    names = myfile.read().split(',')
    
with open("./ttt","w") as mf:
	mf.write("v");

students = []

readtext = ""

with open("../../temp/out.txt","r") as myfile:
    readtext = myfile.read().replace('\n',' ')

writeTo = open("../../temp/output.txt","w")

#sprint readtext

match = re.split("[RBH]ay",readtext)#"(?<=[0-9])\. \w+",readtext)

#print match[1]
print match

redNames = []

curr = 1

winTemp = re.split("wins",readtext.lower())[1][1:].split(' ')
print winTemp

for line in match[1:]:
    temp = re.search("[\(\[].*?[\]\)]",line)#"[RBH]ay",line)
    
    #print line
    #print temp
    if temp is not None:
        name = re.search("[\(\[].*?[\]\)]",line)
        if name is not None:
            redNames.append(name.group(0)[1:len(name.group(0))-1])
            #searchString = match[curr-1][len(match[curr-1])-15:]
            searchString = line.split(")")[1]
	    num = re.search("[0-9]+",searchString);
            #lin = int(num.group(0))
            #print winTemp[lin]
	    print "HERE IS WINS",num.group(0)
	    lin = int(num.group(0))
            students.append(student(redNames[len(redNames)-1],"",lin))
    curr+=1



prob = []
trueNames = []

charSum = 0.0
lowest = 9999.0
topName = ""
toptopProb=0.0

#print redNames
count = 0
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
    trueNames.append(topName.title())
    students[count].predictedName = topName.title()
    print "LOWEST"
    print topName
    print redName
    print toptopProb
    print "-------"
    count+=1

print "top"
print trueNames
print redNames
contents = ""
for s in students:
    print s.readName
    print s.predictedName
    print s.wins
    #print s.line
    contents+=s.predictedName+":"+s.readName+":"+str(s.wins)+","


writeTo.write(contents[:len(contents)-1])
writeTo.close()
