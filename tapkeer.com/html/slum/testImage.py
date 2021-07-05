import os,cv2
from keras.models import load_model
import numpy as np
import glob
import csv
import image_slicer

model = load_model('model.h5')
model.compile(loss= 'binary_crossentropy', optimizer='rmsprop', metrics=['accuracy'])

kuthey = os.getcwd()
tyachyat_kuthey = kuthey + '/uploads/*'

block_path = glob.glob(tyachyat_kuthey)


# image = cv2.imread(tyachyat_kuthey + "/Screenshot (540).png")
# # image = cv2.resize(image, (128,128))
#
#
# image_slicer.slice(tyachyat_kuthey + "/Screenshot (540).png",15)



n=1
gotIt = 0
for blocks in block_path:
    image = cv2.imread(blocks)
    # cv2.imshow('image', image)
    # cv2.waitKey(0)
    # cv2.destroyAllWindows()

    image = cv2.resize(image, (200, 200))
    n = n+1
    image = np.reshape(image,[1,200,200,3])
    result = model.predict(image)
    print(result)
    # print(result[0,0])
    # if result[0,0]  >= 1:
    #     gotIt = gotIt + 1




# Write the result
#
# with open("percentage.csv","w") as f:
#     writer = csv.writer(f)
#     writer.writerow([gotIt,gotIt])
#     f.close()
#
# input()



