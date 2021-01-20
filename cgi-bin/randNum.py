#!/usr/bin/python3

import random
from datetime import datetime

#print("Random number with system time")
random.seed(datetime.now())

print ('Content-type: text/html\n');
print ('Number: ' + str(random.randint(1, 10)))

