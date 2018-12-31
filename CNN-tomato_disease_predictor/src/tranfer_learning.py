from keras.models import Model
from keras.layers import Dense, MaxPooling2D, Dropout,GlobalAveragePooling2D
from keras.applications.inception_v3 import InceptionV3, preprocess_input

train_dir='../images/train'
test_dir='../images/test'

classes=5
base_model=InceptionV3(weights='imagenet',include_top=False)


x=base_model.output
x=GlobalAveragePooling2D()(x)
x=Dense(1024,activation='relu')(x) #we add dense layers so that the model can learn more complex functions and classify for better results.
x=Dense(1024,activation='relu')(x) #dense layer 2
x=Dense(512,activation='relu')(x) #dense layer 3
preds=Dense(5,activation='softmax')(x) 

model=Model(input=base_model.input,output=preds)
for layer in base_model.layers:
	layer.trainable=False

model.compile(loss='categorical_crossentropy',metrics=['accuracy'],optimizer='Adadelta')

#Now comes Adding augmentation part so that 10 tomatoes images could be increased to more in numbers by different operations

from keras.preprocessing.image import ImageDataGenerator
width=299
height=299
#(fixed values for training this model) as it was trained with this format on original training 
batch_size=32
#preprocessing fun for mean normalizing
train_datagen=ImageDataGenerator(preprocessing_function=preprocess_input, rotation_range=40,width_shift_range=0.2,shear_range=0.2,zoom_range=0.2,horizontal_flip=True)

validation_datagen=ImageDataGenerator(preprocessing_function=preprocess_input,rotation_range=40,width_shift_range=0.2, shear_range=0.2,zoom_range=0.2,horizontal_flip=True)

train_generator=train_datagen.flow_from_directory(train_dir,target_size=(height,width),batch_size=batch_size, class_mode='categorical')

validation_generator=validation_datagen.flow_from_directory(test_dir,target_size=(height,width),batch_size=batch_size, class_mode='categorical')
#Finally the transfer learning

n_epochs=5
n_batch=32
n_steps_per_epoch=320
n_validation_steps=64
model_file='disease.model.h5'
training=model.fit_generator(train_generator,epochs=n_epochs,steps_per_epoch=n_steps_per_epoch, validation_data=validation_generator,validation_steps=n_validation_steps)

model.save(model_file)

 

