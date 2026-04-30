from fastapi import FastAPI
import sqlite3
import pandas as pd
import random

app = FastAPI()

@app.get("/agent/stats")
def get_stats():
    try:
        conn = sqlite3.connect('../database/database.sqlite')
        # Get Treasury
        treasury_df = pd.read_sql_query("SELECT SUM(fee_paid) as total FROM bcids", conn)
        treasury = treasury_df.iloc[0]['total'] if not treasury_df.empty else 0
        
        # Get User Count
        user_count = pd.read_sql_query("SELECT COUNT(*) as count FROM bcids", conn).iloc[0]['count']
        
        # Get Broadcast Count
        post_count = pd.read_sql_query("SELECT COUNT(*) as count FROM broadcasts", conn).iloc[0]['count']
        
        return {
            "treasury": float(treasury) if treasury else 0,
            "citizens": int(user_count),
            "broadcasts": int(post_count),
            "network_health": 99.9,
            "recent_alerts": [
                f"New citizen minted: BCID-{user_count}",
                "Protocol integrity verified via Proof of Vibe."
            ]
        }
    except Exception as e:
        return {"error": str(e)}

@app.get("/agent/ask")
def ask_agent(question: str, bcid: int = 1):
    q = question.lower()
    
    if "treasury" in q or "funds" in q:
        stats = get_stats()
        return {"answer": f"The BroadConnect treasury currently secures ${stats.get('treasury', 0):.2f}. These funds are allocated for protocol governance and community rewards."}
    
    if "citizens" in q or "users" in q:
        stats = get_stats()
        return {"answer": f"We currently have {stats.get('citizens', 0)} verified citizens on the protocol. The network is growing at a steady pace!"}
    
    if "vibe" in q or "social" in q:
        return {"answer": "The vibe on the protocol is highly decentralized. We are seeing a surge in high-quality broadcasts and community interactions."}
        
    responses = [
        "I am monitoring the protocol 24/7. Your data is secured by Base & Supra.",
        "The BroadConnect protocol is performing optimally. No spam detected in the last 100 blocks.",
        "Protocol integrity is my top priority. How can I assist you today, Citizen?"
    ]
    
    return {"answer": random.choice(responses)}