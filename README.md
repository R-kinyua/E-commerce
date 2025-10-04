
# Apollo: Dockerized Clothing Web App with DevOps Pipeline

## Overview
Apollo is a modern clothing web application designed to showcase and sell apparel online. The project demonstrates a full DevOps workflow, including CI/CD, containerization, AWS deployment, monitoring, and security best practices.

---

## Features
- Stylish, responsive web interface for browsing and purchasing clothing.
- Built with PHP/Apache and static assets.
- Dockerized for easy deployment and scalability.
- Automated CI/CD pipeline using GitHub Actions.
- Infrastructure as Code (IaC) with Terraform for AWS (EC2, S3, Security Groups).
- Monitoring with Prometheus, cAdvisor, node_exporter, and Grafana.
- DevSecOps: Docker image scanning with Trivy and secret management.

---

## Project Structure
```
Devops/
├── Dockerfile
├── docker-compose.yml
├── .github/workflows/ci-cd.yml
├── terraform/
│   ├── main.tf
│   ├── variables.tf
│   └── terraform.tfvars
├── prometheus.yml
├── docker-compose.prometheus.yml
├── docker-compose.monitoring.yml
├── docker-compose.grafana.yml
├── README.md
└── ... (Apollo app source files)
```

---

## How to Deploy Apollo to a Server

### Prerequisites
- AWS account (with IAM user and permissions)
- Docker & Docker Compose installed
- Terraform installed
- GitHub account

### 1. Clone the Repository
```
git clone <your-repo-url>
cd Devops
```

### 2. Configure AWS Credentials
```
aws configure
```

### 3. Provision AWS Infrastructure (Terraform)
```
cd terraform
terraform init
terraform plan
terraform apply
```

### 4. Build & Push the Docker Image
```
docker build -t <dockerhub-username>/apollo:latest .
docker push <dockerhub-username>/apollo:latest
```

### 5. Deploy Apollo on EC2
SSH into your EC2 instance and run:
```
docker run -d -p 80:80 <dockerhub-username>/apollo:latest
```

### 6. Set Up Monitoring (Prometheus, cAdvisor, node_exporter, Grafana)
Copy the monitoring compose files to your EC2 instance and run:
```
docker-compose -f docker-compose.prometheus.yml up -d
docker-compose -f docker-compose.monitoring.yml up -d
docker-compose -f docker-compose.grafana.yml up -d
```

### 7. Access Apollo and Monitoring Tools
- Apollo App: http://<ec2-public-ip>/
- Prometheus: http://<ec2-public-ip>:9090
- Grafana: http://<ec2-public-ip>:3000 (admin/admin)

---

## Example Grafana Metrics
- **System CPU Usage:**
  ```
  100 - (avg by (instance) (irate(node_cpu_seconds_total{mode="idle"}[5m])) * 100)
  ```
- **System Memory Usage:**
  ```
  (node_memory_MemTotal_bytes - node_memory_MemAvailable_bytes) / node_memory_MemTotal_bytes * 100
  ```
- **Container CPU Usage:**
  ```
  rate(container_cpu_usage_seconds_total[5m])
  ```
- **Container Memory Usage:**
  ```
  container_memory_usage_bytes
  ```
- **Target Up Status:**
  ```
  up
  ```

---

## Security & Best Practices
- IAM user with least privilege for Terraform
- No root AWS keys used
- Secrets managed via GitHub Secrets
- Docker images scanned with Trivy

---

## License
This project is licensed under the MIT License.
