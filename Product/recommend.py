import sys, json
import pandas as pd

df = pd.read_csv('ecommerce.csv',error_bad_lines=False,encoding='latin-1')




def recommend_category(category):
    jk=df[df['category']==category]
    product=jk[jk['product-ratings']>=4.1]
    product=product.sort_values(ascending=False, by='price')
    return product
   
def recommend_subcategory(subcategory):
    jk=df[df['subcategory']==subcategory]
    product=jk[jk['product-ratings']>=1]
    product=product.sort_values(ascending=False, by='price')
    product=product['id']
    ar=[]
    for pro in product:
        ar.append(pro)
    return json.dumps(ar)

def recommend_products(product_name):
    indices = pd.Series(df.index, index=df['product-name'])
    ind=indices[product_name]
    jk=df[(df['brand']==df['brand'].iloc[ind]) | (df['subcategory']==df['subcategory'].iloc[ind])]# | (df['category']==df['category'].iloc[ind])]
    product=jk[jk['product-ratings']>=4.1]
    product=product.sort_values(ascending=False, by='price')
    product=product['id']
    ar=[]
    for pro in product:
        ar.append(pro)
    return json.dumps(ar)
    
def recommend_brand(brand):
    jk=df[df['brand']==brand]
    product=jk[jk['product-ratings']>=4.1]
    product=product.sort_values(ascending=False, by='price')
    return product




#with open('test.json') as f:
data=sys.argv[1]
    
#b=[]
#for name in data:
    #b.append(name)

    
#f=open("written.json","w+")
#f.write(recommend_products(b[0]))
#f.close()
print(recommend_subcategory(data))

