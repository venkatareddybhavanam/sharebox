class Asset < ActiveRecord::Base
  attr_accessible :user_id, :uploaded_file  
  belongs_to :user
  
  #set up "uploaded_file" field as attached_file (using Paperclip)  
has_attached_file :uploaded_file, 
                  :url => "/assets/get/:id",  
                  :path => "C:/rails/sharebox/assets/:id/:basename.:extension" 

validates_attachment_size :uploaded_file, :less_than => 10.megabytes    
validates_attachment_presence :uploaded_file  
def file_name  
    uploaded_file_file_name  
end 
def file_size  
    uploaded_file_file_size  
end  
end
