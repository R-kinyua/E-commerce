variable "key_name" {
  description = "Name of the SSH key pair to use for EC2 instance"
  type        = string
}

variable "s3_bucket_name" {
  description = "Name for the S3 bucket"
  type        = string
}
