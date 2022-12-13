
# Row Transposition Cipher Implementation

A program written in python programming language to encrypt and decrypt data using two methods dictionaries and matrix.

## Getting Started

These type of transposition cipher implementation project has no dependency. 

# Encryption 

Dictionary and arrays are used for encryption. The dictionary function stores the unencrypted text.

``` 
    def Main_Encrypted_dictionaries_arrays():
    print("\nEncrypt The Unencrypted Message M = ")     
    msg = input().replace(" ", "")
    # The word w is a key
    print("\nEnter the Key of w ")
    key = input()   
    #create an empty dictionary
    combine_dict = {}
```
* The unencrypted message is stored in M, the key value will be in 'w'. 

``` 
    # msg.lower() means all input message covert to lowercase
    Encrypted(combine_dict, msg_extend(msg.lower(),len(key)),key)
```
* Here encrypted message get stored in an empty dictionary (note: the text is put in lowercase)
* Based on the pattern from key the text shall be arranged and stored in the dictionary. 

``` 
    print("\nUnencrypted Message is M = ", msg)
    print("\nThe Key of w = ", key)
    print("\nEncrypted Message is C = ", Encrypted_sorted(combine_dict, sorted_str = "")) 
    ```
* Here we are able to print all the inputs together.
```
Array = [""] * len(key)
    for column_length in range (len(key)):  
        msg_length = column_length
        while msg_length < len(msg_filled): 
```

``` 
Array[column_length] += msg_filled[msg_length] 
msg_length = msg_length + len(key)   
```

Example: Message M= How are you (array)
         Let the key= NYIT

    | N | Y | I | T |
    |---|---|---|---|
    | h | o | w |   |
    | a | r | e |   |
    | y | o | u | X |
Encrypted message: .py file

# Decryption

Dictionary and arrays are used for decryption.

* The is the layout to print a decrypted text from the encrypted message C
```
def Main_Decrypted_dictionaries_arrays():
    print("\nEnter the Encrypted Message C = ")
    msg = input().lower()
    print("\nEnter The Key of W  = ")
    key = input()
   
    num_row = math.ceil(len(msg)/len(key)) # it calculates the no. of rows
   
    combine_dict = {}
    Decrypted(combine_dict,msg_extend(msg,len(key)),key,num_row)
    print("\nEncrypted Message is C = ",msg)
    print("\nThe key of w = ",key)
    print("\nDecrypted Message is M = ", Decrypted_sorted(combine_dict,key,num_row,sorted_str = ""))
```

Here we reach to the Ciphertext to be decrypted 
# Q5 Ciphertext
#eroohalpsmeptroohalsefxphtnlefhhxtwstiiiieoecrastitosplmgeasentmitrasnefylypnhiasnetoiroitaetaxoeetonicrasetltesnicrfwmurnhrrhitrcrxhtpipsrmaimiitpiphlaleiucciptotpe  

* This again uses the same technique of storing the cipher text to dictionary(not empty) in the form of array but viceversa to decrypt the ciphertext to plaintext to return plaintext.
```
for column_length in range (num_row):
        msg_length = column_length
        while msg_length < len(sorted_str):
            plaintext[column_length] += sorted_str[msg_length]
            msg_length = msg_length + num_row             
    return "".join(plaintext)
```
Another approach is implementation through matrix

# Encryption & Decryption using Matrix 

While using a matrix to encrypt the unencrypted message we use the main function, here we set the key-pointer (i.e, 'w' key value) as id numbers for each cell of the matrix.

```
def key_pointer(w, key_id_number):
    position_number = ""
    for i in range(len(w) + 1):
        for j in range(len(w)):
            if key_id_number[j] == i:
                position_number += str(j)
    return position_number
```  
```  
def key_id(w):
    alphabet = "abcdefghijklmnopqrstuvwxyz"
    numbers_to_key = list(range(len(w)))
    # print(kywrdNumList)
    total = 0
    for i in range(len(alphabet)):
        for j in range(len(w)):
            if alphabet[i] == w[j]:
                total += 1
                numbers_to_key[j] = total
            # if
        # inner for
    # for
    return numbers of key
```
* Feed the matrix with the content, in this case alphabet to choose for the required task.
```
def Main_Encrypted_matrix_arrays():
    M = input("\nEncrypt The Unencrypted Message M = ").replace(" ", "").lower()
    w = input("\nEnter the Key of w = ").lower()
    numbers_to_key = key_id(w)
    add_charac = len(M) % len(w)
    joker = len(w) - add_charac
    if add_charac != 0:
        for i in range(joker):
            M += "X"
    # if

    matrix_rows = int(len(M) / len(w))
    ```
* these commands allow the characters to fit into the grid perfectly.
* in case of shortage "add_charac = len(M) % len(w)" is implemented.
  
The next steps will be converting the characterd and decrypting.

* The following code helps in conversion of the message into the grid of the matrix.
```
matrix = [[0] * len(w) for i in range(matrix_rows)]
    z = 0
    for i in range(matrix_rows):
        for j in range(len(w)):
            matrix[i][j] = M[z]
            z += 1
        # for
    # for
    # getting locations of numbers
    position_number = key_pointer(w, numbers_to_key)
    # cipher
    text_to_encrypt = ""
    encrypt_counter = 0
    for i in range(matrix_rows):
        if encrypt_counter == len(w):
            break
        else:
            h = int(position_number[encrypt_counter])
        # if
        for j in range(matrix_rows):
            text_to_encrypt += matrix[j][h]
        # for
        encrypt_counter += 1
    # for

    print("\nEncrypted Message is C = ",text_to_encrypt)
``` 
Decryption (main function)
```
def Main_Decrypted_matrix_arrays():
    M = input("\nEnter the Encrypted Message C = ").lower()
    w = input("\nEnter the Key of w = ").lower()
    # assigning numbers to keywords
    numbers_to_key = key_id(w)

    matrix_rows = int(len(M) / len(w))

    # getting locations of numbers
    position_number = key_pointer(w, numbers_to_key)
    # Converting message into a grid
    matrix = [[0] * len(w) for i in range(matrix_rows)]
    
    plain_text = ""
    decrypt_counter = 0
    decrypt_counter2 = 0
  

    for i in range(len(M)):
        h = 0
        if decrypt_counter == len(w):
            decrypt_counter = 0
        else:
            h: int = int(position_number[decrypt_counter])
        for j in range(matrix_rows):
            matrix[j][h] = M[decrypt_counter2]
            decrypt_counter2 += 1
        if decrypt_counter2 == len(M):
            break
        decrypt_counter += 1
    print()
    for i in range(matrix_rows):
        for j in range(len(w)):
            plain_text += str(matrix[i][j])
    print("\nEncrypted Message is C = " + plain_text)
```
# main() function of the Decryption using matrix
```
def main(): 
    print("\n------------We use two approaches to finish the assignemnt in our group----------\n")      
    print("Choose 1 for Encrypt algorithm data type using dictionaries and arrays\n")
    print("Choose 2 for Encrypt algorithm data type using matrix and arrays\n")
    print("Choose 3 for Decrypt algorithm data type using dictionaries nd arrays\n")
    print("Choose 4 for Decrypt algorithm data type using matrix and arrays")
    print("\nPlease select a choice:")
    choice = int(input())

    if choice ==  1:
        Main_Encrypted_dictionaries_arrays()
        
    elif choice == 2:
        Main_Encrypted_matrix_arrays()

    elif choice == 3:
        Main_Decrypted_dictionaries_arrays()

    elif choice == 4:
        Main_Decrypted_matrix_arrays()

    else:
        print("Exit the menu")
main()
```

## Use of Docker

This part shall be a verification of how the python file and docker file, showing that python runs in docker with output. 
The docker uses certain commands:
* “docker build. -f  Dockerfile –t Secret”
* “ docker run –it Secret .”
