# -*- coding: utf-8 -*-

import re

schoolname = {"Cypress Bay"}

names = {"Zonshen Yu","Hannah Kang","Eli Nir","Daniel Ruiz","Caleb Wong","Amun Majeed"}

readtext = """2015 Sunvitational -- Novice LD

University School of NSU

Top 20 Prelim Contestants

I. Lak: Highland Prcpan: l-IK (1-Iannnh Koegler_(n))

2. Lake Highland Prepare ML (Max Lyscnk0_(n))

3 American Hbritagﬁ HQQAD (Abhilash Dani)

4. Cyprcss Bay ZY [ZUn:1'|€l'| Y“)

5. Lake Highland Prepara CA (CateAdams_(n))

6. Wbst Bmward VK (Victoria King)

7. Lake Highland Prcpam I W (J ulin Wu_(n))

3. Cypress Bay HK (Hannah Kang)

9. American Heritage Plu DM (David Min)

I0. Christopher Columbus AT (Angel Tom)

| 1. q-prim Bay EN (EliN1r)

I2. Collegiate NM (Nicholas Monaco)

13. Lake Ihghiand Prepam ss (Sachin sm11_(n))

I4. Bnca Ratun Community NM (Nicholas Marques) 15. Cypress Bay DR (Daniel Ruiz)

16 Cypress Ray CW (Caleb Wong)

17. Pine View TA (Thomas Allm)

1x. Christopher llnlumbus Bl (Brian Izquicnlo)

19. Amcncun X-lcriugge Buc EM (Eswar Mohan)

20. Cypress BayAM (Amlln Majeed)

January 10-11, 2015

W

5

S

5

5

5

4

4

4

4

4

4

4

4

3

3

3

3

3

3

3

INS

H/L

118

117

116

113

113

117

116

115

115.5

114

113.5

113.5

113

114

113.9

112.7

112.5

112

lll.5

lll

OppWn T H/L

18

20

26

21

I9

I7

22

I8

l7

16

2|

17

Z4

13

23

18

19

18

23

12

IVAR

1.11

1.37

1.1

.42

.22

.71

1.04

.77

.s1 .4 .66 .45 .24 -.25 .23 05

15 -.15 -so -.64

303

668

670

139

922

84 1

771

739

699

267

45 l

603

187

926

658

440

448

429

Z12

695"""

match = re.split("(?<=[0-9]). \w+",readtext)

#print match[1]
#print match

redNames = []

for line in match:
    temp = re.search("[RB]ay",line)
    if temp is not None:
        name = re.search("[\(\[].*[\]\)]",line)
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
